# array-helper-function

This adds functions about array. If you feel like there few php built-in functions about array, this will be useful.

# Installation

if you're using Composer to manage dependencies, you can include the following in your composer.json file:

```json
"require": {
    "mitsuru793/array-helper-function
}
```
Then, after running composer update or php composer.phar update, you can load the class using Composer's autoloading:

```php
require 'vendor/autoload.php';
```

# Functions 

## condtion
* [is_empty_array](#is_empty_arrayvalue-bool)
* [is_full_array](#is_full_arrayvalue-bool)
* [is_numeric_array](#is_numeric_arrayvalue-bool)
* [is_numeric_array_recursive](#is_numeric_array_recursivearray-bool)
* [array_every](#array_everyarray-array-callable-test--null-bool)
* [array_any](#array_anyarray-array-callable-test--null-bool)

## each
* [array_keys_recursive](#array_keys_recursivearray-array-array)
* [array_diff_key_recursive](#array_diff_key_recursivearray-main-array-other-array)
* [array_filter_recursive](#array_filter_recursivearray-callable-test--null-array)

## access
* [array_get](#array_getarray-array-path-string-separator--)
* [array_pick](#array_pickarray-array-array-values-array)

### Function detail

#### is_empty_array($value): bool

Finds whether a variable is a empty array.

return true when value is
* `[]`

returns false when value is
* not array(ex: `0`, `1`, `true`, `null` ...)
* `[1, 2]`
* `[null]`
* `[[], []]`

```php
is_empty_array([]) // true
```

#### is_full_array($value): bool

Finds whether a variable is a full array, so it's not empty array.

return true when value is
* `[1, 2]`
* `[null]`
* `[[], []]`

returns false when value is
* `[]`
* not array(ex: `0`, `1`, `true`, `null` ...)


```php
is_full_array([1]) // true
```

#### is_numeric_array($value): bool

Finds whether all keys of variable are integer. This does not find deeply if element of `$value` is array.

return true when value is
* `[]`
* `[null]`
* `[['k1' => 'v1'], 'v2]`

returns false when value is
* not array(ex: `0`, `1`, `true`, `null` ...)
* `['k1' => 'v1', 'v2]`

```php
is_numeric_array([1]) // true
```

#### is_numeric_array_recursive($array): bool

Finds whether all keys of variable are integer deeply. This is like [is_numeric_array](#is_numeric_array)

return true when value is
* `[]`
* `[null]`

returns false when value is
* not array(ex: `0`, `1`, `true`, `null` ...)
* `['k1' => 'v1', 'v2]`
* `[['k1' => 'v1'], 'v2]`

```php
is_numeric_array_recursive([1]) // true
```

#### array_every(array $array, callable $test = null): bool

Verify that all elements of a `$array` pass a given truth `$test`.

```php
array_every([1, 2, 3], function ($value, $key) {
    retrun $value > 2;
});
// false
```

If the `$array` is empty, every will return true.
```php
array_every([]) // true
```

If the `$test` is null, verify all them are truly.
```php
array_every([1, 2, 3]);
// true
```

#### array_any(array $array, callable $test = null): bool

Verify that a element of a `$array` pass a given truth `$test`.

```php
array_every([1, 2, 3], function ($value, $key) {
    retrun $value > 2;
});
// true
```

If the `$array` is empty, every will return false.
```php
array_every([]) // false
```

If the `$test` is null, verify one is truly.
```php
array_every([1, 2, 3]);
// true
```

#### array_keys_recursive(array $array): array

This is like  [array_keys](http://php.net/manual/en/function.array-keys.php), but recursively. Return combinations of all keys.

```php
$array = [
    'Japan' => [
        'Tokyo' => [
            'user1' => 'Mike',
            'user2' => 'Jane',
            'Hiro',
            'Hanako',
        ],
        'Kyoto' => [],
    ],
    'Take',
];

array_keys_recursive($array);
// [
//     ['Japan', 'Tokyo', 'user1'],
//     ['Japan', 'Tokyo', 'user2'],
//     ['Japan', 'Tokyo', 0],
//     ['Japan', 'Tokyo', 1],
//     ['Japan', 'Kyoto'],
//     0,
// ]
```

#### array_diff_key_recursive(array $main, array $other): array

This is like [array_diff_key](http://php.net/manual/en/function.array-diff-key.php), but recursively.

```
$main = [
    'user' => [
        'name' => 'Mike',
        'age' => 20,
    ],
];
$other = [
    'id' => 2,
    'user' => [
        'name' => 'Jane',
        'from' => 'America',
        'sex' => 'woman',
    ],
];

array_diff_key_recursive($main, $other));
// [
//     'user' => [
//         'age' => 20
//     ]
// ] 

array_diff_key_recursive($other, $main));
// [
//     'id' => 2,
//     'user' => [
//         'from' => 'America',
//         'sex' => 'woman',
//     ],
// ]
```

#### array_filter_recursive($array, callable $test = null): array

This is like [array_filter](http://php.net/manual/en/function.array-filter.php), but recursively. The closure `$test` is passed `$key` by default. 


```php
$array = [
    'Japan' => [
        'Hiroki-Man',
        'Kaede-Woman',
        'Tokyo' => [
            'Taro-Man',
            'Hanako-Woman',
        ],
    ],
    'America' => [
        'Jane-Woman',
        'Mike-Man',
    ],
];

array_filter_recursive($array, function ($v, $k) {
    if (!is_string($v)) {
        return true;
    }
    return preg_match('/Man/', $v);
});
// [
//     'Japan' => [
//         'Hiroki-Man',
//         'Tokyo' => [
//             'Taro-Man',
//         ],
//     ],
//     'America' => [
//         1 => 'Mike-Man',
//     ],
// ]
```

#### array_get(array $array, $path, string $separator = '.') 

Retrieves a value from a nested array. Notation of `$path` is dot or array. If `$path` is string, you can modify its separator from dot as 3rd argument.

```php
$array = [
    'user' => [
        'name' => 'mike',
    ],
];

array_get($array, ['user', 'name']);
array_get($array, 'user.name');
array_get($array, 'user_name', '_');
// mike

array_get($array, 'invalid');
// null
```

#### array_pick(array &$array, array $values): array

Find whether `$values` match elements of `$array` strictly, and takes matched values from `$array`. Has side effect and modify `$array`.

```
$array = ['a', null, true, 'b'];


$picked;
// [0 => 'a', 2 => true]

$array;
// [1 => null, 3 => 'b']
```
