# Setup de um Projeto Laravel

## [Criar novo projeto laravel](https://laravel.com/docs/9.x#installation-via-composer)

```bash
composer create-project laravel/laravel novo-app
```

---

## 1. [PHP CS Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)

```bash
composer require friendsofphp/php-cs-fixer --dev
```

### Config file

`php-cs-fixer.php`

```php
<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$rules = [
    '@PSR2'                                       => true,
    'align_multiline_comment'                     => false,
    'array_indentation'                           => true,
    'array_syntax'                                => ['syntax' => 'short'],
    'binary_operator_spaces'                      => [
        'default' => 'align_single_space_minimal',
    ],
    'blank_line_after_namespace'                  => true,
    'blank_line_after_opening_tag'                => false,
    'blank_line_before_statement'                 => ['statements' => ['break', 'continue', 'declare', 'return', 'throw', 'try']],
    'braces'                                      => [
        'allow_single_line_closure'                   => false,
        'position_after_anonymous_constructs'         => 'same',
        'position_after_control_structures'           => 'same',
        'position_after_functions_and_oop_constructs' => 'next',
    ],
    'cast_spaces'                                 => ['space' => 'none'],
    // 'class_attributes_separation' => [
    //     'elements' => ['method', 'property'],
    // ],
    'no_unused_imports'                           => true,
    'combine_consecutive_issets'                  => false,
    'combine_consecutive_unsets'                  => false,
    'combine_nested_dirname'                      => false,
    'comment_to_phpdoc'                           => false,
    'compact_nullable_typehint'                   => false,
    'concat_space'                                => ['spacing' => 'one'],
    'constant_case'                               => [
        'case' => 'lower',
    ],
    'date_time_immutable'                         => false,
    'declare_equal_normalize'                     => [
        'space' => 'single',
    ],
    'declare_strict_types'                        => false,
    'dir_constant'                                => false,
    'doctrine_annotation_array_assignment'        => false,
    'doctrine_annotation_braces'                  => false,
    'doctrine_annotation_indentation'             => [
        'ignored_tags'       => [],
        'indent_mixed_lines' => true,
    ],
    'doctrine_annotation_spaces'                  => [
        'after_argument_assignments'     => false,
        'after_array_assignments_colon'  => false,
        'after_array_assignments_equals' => false,
    ],
    'elseif'                                      => false,
    'encoding'                                    => true,
    'indentation_type'                            => true,
    'no_useless_else'                             => true,
    'no_useless_return'                           => true,
    'ordered_imports'                             => true,
    'single_quote'                                => false,
    'ternary_operator_spaces'                     => true,
    'no_extra_blank_lines'                        => true,
    'no_multiline_whitespace_around_double_arrow' => true,
    'multiline_whitespace_before_semicolons'      => true,
    'no_singleline_whitespace_before_semicolons'  => true,
    'no_spaces_around_offset'                     => true,
    'ternary_to_null_coalescing'                  => true,
    'whitespace_after_comma_in_array'             => true,
    'trim_array_spaces'                           => true,
    'unary_operator_spaces'                       => true,
];

$finder = new Finder();

$finder->in([
    __DIR__ . '/app',
    __DIR__ . '/database',
]);

$config = new Config();

$config->setIndent('    ');

$config
    ->setRiskyAllowed(false)
    ->setRules($rules)
    ->setFinder($finder);

return $config;
```

### Run

`./vendor/bin/php-cs-fixer fix `

### Ref

[Workenck/Shift](https://gist.github.com/laravel-shift/cab527923ed2a109dda047b97d53c200)

---

## 2. [Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer)

```bash
composer require squizlabs/php_codesniffer --dev
```

### Config file

`phpcs.xml`

```xml
<?xml version="1.0"?>
<ruleset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         name="Pinguim"
         xsi:noNamespaceSchemaLocation="https://raw.githubusercontent.com/squizlabs/PHP_CodeSniffer/master/phpcs.xsd">

    <description>The coding standard for Pinguim do Laravel.</description>

    <file>app</file>

    <arg name="basepath" value="."/>
    <arg name="colors"/>
    <arg name="parallel" value="75"/>
    <arg value="np"/>

    <rule ref="Generic.Commenting.Todo">
        <type>error</type>
    </rule>

    <rule ref="PSR2.Methods.MethodDeclaration.Underscore">
        <type>error</type>
    </rule>

    <rule ref="PSR2.Classes.PropertyDeclaration.Underscore">
        <type>error</type>
    </rule>
</ruleset>
```

### Run

`./vendor/bin/cs`

### Ref

[laravel-phpcs](https://github.com/mreduar/laravel-phpcs/blob/master/phpcs.xml)

---

## 3. [LaraStan](https://github.com/nunomaduro/larastan)

```bash
composer require nunomaduro/larastan:^2.0 --dev
```

### Config file

`phpstan.neon`

```neon
includes:
    - ./vendor/nunomaduro/larastan/extension.neon

parameters:

    paths:
        - app

    # The level 9 is the highest level
    level: 5

    checkMissingIterableValueType: false
```

### Run

`./vendor/bin/phpstan analyse`

### Ref [PHPStan](https://phpstan.org/config-reference)

---

## 4. [Pest](https://pestphp.com/)

```bash
composer require pestphp/pest --dev --with-all-dependencies
composer require pestphp/pest-plugin-laravel --dev
composer require pestphp/pest-plugin-parallel --dev

php artisan pest:install
```

### Run

`./vendor/bin/pest --parallel`

---

## 5. [DebugBar](https://github.com/barryvdh/laravel-debugbar)

```bash
composer require barryvdh/laravel-debugbar --dev
```

---

## 6. [Telescope](https://laravel.com/docs/9.x/telescope#local-only-installation)

```bash
composer require laravel/telescope --dev

php artisan telescope:install

php artisan migrate
```

Add in file `App\Providers\AppServiceProvider`:

```php
public function register()
{
    if ($this->app->environment('local')) {
        $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        $this->app->register(TelescopeServiceProvider::class);
    }
}
```

Adding the following to your `composer.json` file:

```json
"extra": {
    "laravel": {
        "dont-discover": [
            "laravel/telescope"
        ]
    }
},
```

**\*Dark mode**: uncomment (line 19) `Telescope::night();` in file `app/Providers/TelescopeServiceProvider.php`.\*

---

---

## Git Hooks

### Pre-Push

#### file `.git/hooks/pre-push`

```shell
#!/bin/sh


NC='\033[0m'
BBlue='\033[1;34m'
BRed='\033[1;31m'

NAME=$(git branch | grep '*' | sed 's/* //')
echo "\nRunning pre-push hook on: ${BBlue}" $NAME "${NC}\n"

# ---------------------------------------------------------------------------------------------------
# 1. Laravel Stan
echo "\n\n${BBlue}1. Larastan (PHPStan) ${NC}"
./vendor/bin/phpstan analyse

STATUS_CODE=$?

if [ $STATUS_CODE -ne 0 ]; then
    echo "${BRed}1.... larastan/phpstan: deu ruim ${NC}"
    exit 1
fi

# ---------------------------------------------------------------------------------------------------
# 2. PHP Code Sniffer
echo "\n\n${BBlue}2. PHP Code Sniffer ${NC}"
./vendor/bin/phpcs --standard=phpcs.xml

STATUS_CODE=$?

if [ $STATUS_CODE -ne 0 ]; then
    echo "${BRed}2.... php code sniffer${NC}"
    exit 1
fi

# ---------------------------------------------------------------------------------------------------
# 3. PHP Code Fixer
echo "\n\n${BBlue}3. PHP Code Fixer ${NC}"
./vendor/bin/php-cs-fixer fix --dry-run --using-cache=no --verbose --stop-on-violation

STATUS_CODE=$?

if [ $STATUS_CODE -ne 0 ]; then
    echo "${BRed}3.... php code fixer${NC}"
    exit 1
fi

# ---------------------------------------------------------------------------------------------------
# 4. PHP Tests
echo "\n\n${BBlue}4. PHP Unit Tests (Pest) ${NC}"
./vendor/bin/pest --parallel

STATUS_CODE=$?

if [ $STATUS_CODE -ne 0 ]; then
    echo "${BRed}4.... phpunit/pest${NC}"
    exit 1
fi

echo "${BBlue}pushing...${NC}\n"
```

---

### pre-rebase

#### file `.git/hooks/pre-rebase`

```shell
#!/bin/sh
# Disallow all rebasing

NC='\033[0m'
BRed='\033[1;31m'

echo -e "\n${BRed}pre-rebase: Rebase is dangerous! 👿️ Don't do it.${NC}\n"

exit 1
```

---

### commit-msg

#### file `.git/hooks/commit-msg`

```shell
#!/bin/sh

REGEX_ISSUE_ID="[a-zA-Z0-9,\.\_\-]+-[0-9]+"

NC='\033[0m'
BBlue='\033[1;34m'
BRed='\033[1;31m'

# Find current branch name
BRANCH_NAME=$(git symbolic-ref --short HEAD)

# Extract issue id from branch name
ISSUE_ID=$(echo "$BRANCH_NAME" | grep -o -E "$REGEX_ISSUE_ID")
if [-z "$ISSUE_ID"]; then
    echo -e "${BRed}Branch doesn't have Jira task code on itq....${NC}"
    echo -e "${BBlue}You can use ${BRed}git commit -m \"\" --no-verify${BBlue} to avoid this hook.${NC}"
    exit 1
fi
echo "$ISSUE_ID"': '$(cat "$1") > "$1"
```

---
