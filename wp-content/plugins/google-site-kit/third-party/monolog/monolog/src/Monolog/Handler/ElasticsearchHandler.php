<?php

declare (strict_types=1);
/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Google\Site_Kit_Dependencies\Monolog\Handler;

use Google\Site_Kit_Dependencies\Elastic\Elasticsearch\Response\Elasticsearch;
use Throwable;
use RuntimeException;
use Google\Site_Kit_Dependencies\Monolog\Logger;
use Google\Site_Kit_Dependencies\Monolog\Formatter\FormatterInterface;
use Google\Site_Kit_Dependencies\Monolog\Formatter\ElasticsearchFormatter;
use InvalidArgumentException;
use Google\Site_Kit_Dependencies\Elasticsearch\Common\Exceptions\RuntimeException as ElasticsearchRuntimeException;
use Google\Site_Kit_Dependencies\Elasticsearch\Client;
use Google\Site_Kit_Dependencies\Elastic\Elasticsearch\Exception\InvalidArgumentException as ElasticInvalidArgumentException;
use Google\Site_Kit_Dependencies\Elastic\Elasticsearch\Client as Client8;
/**
 * Elasticsearch handler
 *
 * @link https://www.elastic.co/guide/en/elasticsearch/client/php-api/current/index.html
 *
 * Simple usage example:
 *
 *    $client = \Elasticsearch\ClientBuilder::create()
 *        ->setHosts($hosts)
 *        ->build();
 *
 *    $options = array(
 *        'index' => 'elastic_index_name',
 *        'type'  => 'elastic_doc_type',
 *    );
 *    $handler = new ElasticsearchHandler($client, $options);
 *    $log = new Logger('application');
 *    $log->pushHandler($handler);
 *
 * @author Avtandil Kikabidze <akalongman@gmail.com>
 */
class ElasticsearchHandler extends \Google\Site_Kit_Dependencies\Monolog\Handler\AbstractProcessingHandler
{
    /**
     * @var Client|Client8
     */
    protected $client;
    /**
     * @var mixed[] Handler config options
     */
    protected $options = [];
    /**
     * @var bool
     */
    private $needsType;
    /**
     * @param Client|Client8 $client  Elasticsearch Client object
     * @param mixed[]        $options Handler configuration
     */
    public function __construct($client, array $options = [], $level = \Google\Site_Kit_Dependencies\Monolog\Logger::DEBUG, bool $bubble = \true)
    {
        if (!$client instanceof \Google\Site_Kit_Dependencies\Elasticsearch\Client && !$client instanceof \Google\Site_Kit_Dependencies\Elastic\Elasticsearch\Client) {
            throw new \TypeError('Elasticsearch\\Client or Elastic\\Elasticsearch\\Client instance required');
        }
        parent::__construct($level, $bubble);
        $this->client = $client;
        $this->options = \array_merge([
            'index' => 'monolog',
            // Elastic index name
            'type' => '_doc',
            // Elastic document type
            'ignore_error' => \false,
        ], $options);
        if ($client instanceof \Google\Site_Kit_Dependencies\Elastic\Elasticsearch\Client || $client::VERSION[0] === '7') {
            $this->needsType = \false;
            // force the type to _doc for ES8/ES7
            $this->options['type'] = '_doc';
        } else {
            $this->needsType = \true;
        }
    }
    /**
     * {@inheritDoc}
     */
    protected function write(array $record) : void
    {
        $this->bulkSend([$record['formatted']]);
    }
    /**
     * {@inheritDoc}
     */
    public function setFormatter(\Google\Site_Kit_Dependencies\Monolog\Formatter\FormatterInterface $formatter) : \Google\Site_Kit_Dependencies\Monolog\Handler\HandlerInterface
    {
        if ($formatter instanceof \Google\Site_Kit_Dependencies\Monolog\Formatter\ElasticsearchFormatter) {
            return parent::setFormatter($formatter);
        }
        throw new \InvalidArgumentException('ElasticsearchHandler is only compatible with ElasticsearchFormatter');
    }
    /**
     * Getter options
     *
     * @return mixed[]
     */
    public function getOptions() : array
    {
        return $this->options;
    }
    /**
     * {@inheritDoc}
     */
    protected function getDefaultFormatter() : \Google\Site_Kit_Dependencies\Monolog\Formatter\FormatterInterface
    {
        return new \Google\Site_Kit_Dependencies\Monolog\Formatter\ElasticsearchFormatter($this->options['index'], $this->options['type']);
    }
    /**
     * {@inheritDoc}
     */
    public function handleBatch(array $records) : void
    {
        $documents = $this->getFormatter()->formatBatch($records);
        $this->bulkSend($documents);
    }
    /**
     * Use Elasticsearch bulk API to send list of documents
     *
     * @param  array[]           $records Records + _index/_type keys
     * @throws \RuntimeException
     */
    protected function bulkSend(array $records) : void
    {
        try {
            $params = ['body' => []];
            foreach ($records as $record) {
                $params['body'][] = ['index' => $this->needsType ? ['_index' => $record['_index'], '_type' => $record['_type']] : ['_index' => $record['_index']]];
                unset($record['_index'], $record['_type']);
                $params['body'][] = $record;
            }
            /** @var Elasticsearch */
            $responses = $this->client->bulk($params);
            if ($responses['errors'] === \true) {
                throw $this->createExceptionFromResponses($responses);
            }
        } catch (\Throwable $e) {
            if (!$this->options['ignore_error']) {
                throw new \RuntimeException('Error sending messages to Elasticsearch', 0, $e);
            }
        }
    }
    /**
     * Creates elasticsearch exception from responses array
     *
     * Only the first error is converted into an exception.
     *
     * @param mixed[]|Elasticsearch $responses returned by $this->client->bulk()
     */
    protected function createExceptionFromResponses($responses) : \Throwable
    {
        // @phpstan-ignore offsetAccess.nonOffsetAccessible
        foreach ($responses['items'] ?? [] as $item) {
            if (isset($item['index']['error'])) {
                return $this->createExceptionFromError($item['index']['error']);
            }
        }
        if (\class_exists(\Google\Site_Kit_Dependencies\Elastic\Elasticsearch\Exception\InvalidArgumentException::class)) {
            return new \Google\Site_Kit_Dependencies\Elastic\Elasticsearch\Exception\InvalidArgumentException('Elasticsearch failed to index one or more records.');
        }
        return new \Google\Site_Kit_Dependencies\Elasticsearch\Common\Exceptions\RuntimeException('Elasticsearch failed to index one or more records.');
    }
    /**
     * Creates elasticsearch exception from error array
     *
     * @param mixed[] $error
     */
    protected function createExceptionFromError(array $error) : \Throwable
    {
        $previous = isset($error['caused_by']) ? $this->createExceptionFromError($error['caused_by']) : null;
        if (\class_exists(\Google\Site_Kit_Dependencies\Elastic\Elasticsearch\Exception\InvalidArgumentException::class)) {
            return new \Google\Site_Kit_Dependencies\Elastic\Elasticsearch\Exception\InvalidArgumentException($error['type'] . ': ' . $error['reason'], 0, $previous);
        }
        return new \Google\Site_Kit_Dependencies\Elasticsearch\Common\Exceptions\RuntimeException($error['type'] . ': ' . $error['reason'], 0, $previous);
    }
}
