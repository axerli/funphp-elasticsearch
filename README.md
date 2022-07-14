# Elasticsearch

一个基于[elasticsearch/elasticsearch](https://github.com/elastic/elasticsearch-php)简易的Elasticsearch工具包, 对`Document`
的查询操作进行了简单的封装.

## 安装

```bash
composer require funphp/elasticsearch
```

### 使用

#### 引入相关搜索类

在你需要搜索的类中添加 `\Funphp\Elasticsearch\Searchable` trait, 就可以使用相关的搜索操作了.

通过 `searchableIndex()`方法, 就可以指定`index`了.

```php
namespace Start;

use Funphp\Elasticsearch\Searchable;

Class User{
    use Searchable;
    
    public function searchableIndex(): string
    {
        return 'index-user';
    }
}

```

## 查询文档

### 根据指定`id`查询

```php
self::searchable()
    ->searchableId('test-id')
    ->search();
```

### term

```php
self::searchable()
    ->query(function (Query $query) {
        $query->term('status', 1);
    })
    ->search();
```

### match

```php
self::searchable()
    ->query(function (Query $query) {
        $query->match('name', '乌拉');
    })
    ->search();
```

### ids

```php
self::searchable()
    ->query(function (Query $query) {
        $query->ids([1, 2]);
    })
    ->search();
```

### range

```php
self::searchable()
    ->query(function (Query $query) {
        $query->range('age', function (Range $range) {
            $range->gte(20);
        });
    })
    ->search();
```

### bool

#### must

```php
self::searchable()
    ->query(function (Query $query) {
        $query->bool(function (BoolQuery $boolQuery) {
            $boolQuery->must(function (Query $query) {
                $query->range('login_at', function (Range $range) {
                    $range->gte('2021-10-01 00:00:00');
                });
            })->must(function (Query $query) {
                $query->range('age', function (Range $range) {
                    $range->lt(18)->gte(12);
                });
            });
        });
    })
    ->sort(fn(Sort $sort) => $sort->sortBy('age'))
    ->search();
```

#### must_not

```php
self::searchable()
    ->query(function (Query $query) {
        $query->bool(function (BoolQuery $boolQuery) {
            $boolQuery->mustNot(function (Query $query) {
                $query->exists('comments');
            });
        });
    })
    ->from(10)
    ->size(10)
    ->source(['id', 'title', 'content'])
    ->search();
```

- `filter` `should`用法与`must`相同

### `source`

    你可以使用`source` 来指定查询的列

    对于分页查询,你可以使用`from`和`size`方法来实现.

### aggs

```php
self::searchable()
    ->query(function (Query $query) {
        $query->term('status', $status);
    })->aggs(function (Aggregation $aggregation) {
        $aggregation->valueCount('count', 'id')
            ->max('max', 'value')
            ->sum('sum', 'value');
    })->search();
```


