<u>Table of contents</u>

# Restriction of inheritance using the final keyword to reach loose coupling in the application design

The repository contains the code examples for learning from the article on habr.com

Use the following `composer` command to fetch the source code examples: 

```bash
composer create-project parshikovpavel/final-keyword dir/
```

The source code is separated according to the structure of the article. 

For convenience, below are links to source code files and examples of their use to reproduce cases from the article. This information is also separated according to the structure of the article. 

## Introduction

The initial version of [`CommentBlock`](src/Introduction/CommentBlock.php)  class.

## Inheritance issues

### The inheritance violates the principle of the information hiding 

[`CommentBlock`](src/InheritanceIssues/InformationHiding/CommentBlock.php)  parent class and [`CustomCommentBlock`](src/InheritanceIssues/InformationHiding/CustomCommentBlock.php) child class demonstrating violation of the principle of the information hiding.

### Banana-monkey-jungle problem

[`Block`](src/InheritanceIssues/BananaMonkeyJungleProblem/Block.php), [`CommentBlock`](src/InheritanceIssues/BananaMonkeyJungleProblem/CommentBlock.php), [`PopularCommentBlock`](src/InheritanceIssues/BananaMonkeyJungleProblem/PopularCommentBlock.php), [`CachedPopularCommentBlock`](src/InheritanceIssues/BananaMonkeyJungleProblem/CachedPopularCommentBlock.php) classes are examples of a deep inheritance hierarchy.

### Open recursion by default

[`CommentComment::getComment()`](src/InheritanceIssues/OpenRecursionByDefault/CommentBlock.php#L31) and [`CustomCommentBlock::getComment()`](src/InheritanceIssues/OpenRecursionByDefault/CustomCommentBlock.php#L34) have different implementations of behavior. [`CommentBlock::getComments()`](src/InheritanceIssues/OpenRecursionByDefault/CommentBlock.php#L46) method makes 
a [self-call](src/InheritanceIssues/OpenRecursionByDefault/CommentBlock.php#L50) of `$this->getComments()` and relies on the implementation of behavior in the `CommentBlock` class.

`CommentBlock::getComments()` implementations, which is automatically inherited by `CustomCommentBlock`, is incompatible with the behavior of `CustomCommentBlock::getComment()` method. So getting a list of comments doesn't work correctly. You can see this by executing [the following test](tests/InheritanceIssues/OpenRecursionByDefault/CustomCommentBlockTest.php):

```bash
$ vendor/bin/phpunit tests/InheritanceIssues/OpenRecursionByDefault/CustomCommentBlockTest.php --testdox

ppFinal\InheritanceIssues\OpenRecursionByDefault\CustomCommentBlock
 ✘ Returns correct list of comments
   │
   │ Failed asserting that two arrays are equal.
   │ --- Expected
   │ +++ Actual
   │ @@ @@
   │  Array (
   │ -    0 => ppFinal\Comment Object (...)
   │ -    1 => ppFinal\Comment Object (...)
   │ +    0 => null
   │ +    1 => null
   │  )

FAILURES!
Tests: 1, Assertions: 1, Failures: 1.
```

### Control of side effects

[`CountingCommentBlock`](src/InheritanceIssues/ControlOfSideEffects/CountingCommentBlock.php) is a specific type of [`CommentBlock`](src/InheritanceIssues/ControlOfSideEffects/CommentBlock.php)  counting views of particular comments in a PSR-16 compatible cache. [`CountingCommentBlock::viewComment()`](src/InheritanceIssues/ControlOfSideEffects/CountingCommentBlock.php#L35) has a side effect since increments the counter value in the cache. [`CommentBlock::viewComments()`](src/InheritanceIssues/ControlOfSideEffects/CommentBlock.php#L43) combines the comment views into a single view and its implementation is inherited by `CountingCommentBlock` exactly as it is. However this inherited implementation doesn't take into account `CountingCommentBlock` responsibility for counting comment views in the cache. As a result, view counters don't work correctly during calls to `CountingCommentBlock::viewComments()`. The [test](tests/InheritanceIssues/ControlOfSideEffects/CountingCommentBlockTest.php) result below demonstrates this thought:

```bash
$ vendor/bin/phpunit tests/InheritanceIssues/ControlOfSideEffects/CountingCommentBlockTest.php --testdox

ppFinal\InheritanceIssues\ControlOfSideEffects\CountingCommentBlock
 ✘ Counts views of comment
   │
   │ Failed asserting that null matches expected 1.
   │

FAILURES!
Tests: 1, Assertions: 1, Failures: 1.
```

### Base class fragility

An inheritable base class are "fragile" because seemingly safe modifications to it, may cause the derived classes to malfunction. The programmer cannot determine whether a base class change is safe simply by examining in isolation the methods of the base class. So the implementation detail of the base and the derived classes become tightly related.

For example, during code refactoring the programmer change [a single line](src/InheritanceIssues/BaseClassFragility/CommentBlock.php#L47) in `CommentBlock::viewComments()` method to simplify the code and to avoid code duplicate in the future.

```
$view .= $comment->view();   ------>   $view .= $this->viewComment($key);
```

The base class logic remains valid and it continues to pass the tests successfully. However base class isn't completely isolated. As a result,  calling  `CountingCommentBlock::viewComments()` causes double increment of a view counter value. You can explore the problem in detail by studying the [corresponding test](tests/InheritanceIssues/BaseClassFragility/CountingCommentBlockTest.php):

```bash
$ vendor/bin/phpunit tests/InheritanceIssues/BaseClassFragility/CountingCommentBlockTest.php --testdox

ppFinal\InheritanceIssues\BaseClassFragility\CountingCommentBlock
 ✘ Counts views of comment
   │
   │ Failed asserting that 2 matches expected 1.
   │
   │

FAILURES!
Tests: 1, Assertions: 1, Failures: 1.
```

## Applying the final keyword to improve design

### Template method pattern

The [`CommentBlock`](src/ApplyingFinalKeyword/TemplateMethodPattern/CommentBlock.php) is  an abstract superclass which defines the skeleton of subclasses. 

The [`CommentBlock::viewComments()`](src/ApplyingFinalKeyword/TemplateMethodPattern/CommentBlock.php#L30-L34)  is a  final template method which is inherited by subclasses and can't be overridden by them.  It calls the abstract  [`CommentBlock::viewComment()`](src/ApplyingFinalKeyword/TemplateMethodPattern/CommentBlock.php#L23) method concrete implementations of which are provided by subclasses.

The final [`SimpleCommentBlock`](src/ApplyingFinalKeyword/TemplateMethodPattern/SimpleCommentBlock.php) class implements the  [`SimpleCommentBlock::viewComment()`](src/ApplyingFinalKeyword/TemplateMethodPattern/SimpleCommentBlock.php#L13-L16) method which just returns a string view of the comment.

The final [`CountingCommentBlock`](src/ApplyingFinalKeyword/TemplateMethodPattern/CountingCommentBlock.php) class includes different behavior implemented in [`CountingCommentBlock::viewComment()`](src/ApplyingFinalKeyword/TemplateMethodPattern/CountingCommentBlock.php#L30-L34). In addition to returning a string view of the comment, this method increments the counter value in the cache.

### Prefer interface implementation to inheritance

Let's avoid any class coupling by implementation details. 

The [`CommentBlock`](src/ApplyingFinalKeyword/PreferInterfaceImplementation/CommentBlock.php) is an interface which defines the contract and hides implementation details.

The [`SimpleCommentBlock`](src/ApplyingFinalKeyword/PreferInterfaceImplementation/SimpleCommentBlock.php) and [`CountingCommentBlock`](src/ApplyingFinalKeyword/PreferInterfaceImplementation/CountingCommentBlock.php) are final classes that implement this interface but don't have a direct association. As a disadvantage, this classes have the same duplicate implementation of [`viewComments()`](src/ApplyingFinalKeyword/PreferInterfaceImplementation/SimpleCommentBlock.php#L33-L40) method.

### Prefer aggregation to inheritance

The aggregation is the loosest relationship type. Let's use the aggregation in the form of the decorator pattern to replace the inheritance.

The [`CommentBlock`](src/ApplyingFinalKeyword/PreferAggregation/CommentBlock.php) is an interface which defines the contract and hides implementation details. 

The [`SimpleCommentBlock`](src/ApplyingFinalKeyword/PreferAggregation/SimpleCommentBlock.php) is a base final class with base behavior that implements the mentioned interface. 

The [`CountingCommentBlock`](src/ApplyingFinalKeyword/PreferAggregation/CountingCommentBlock.php) is similar to a child class. It stores [a reference](src/ApplyingFinalKeyword/PreferAggregation/CountingCommentBlock.php#L15) to the decorated object,  forwards all calls to it and implements additional behavior. [`CountingCommentBlock::viewComment()`](src/ApplyingFinalKeyword/PreferAggregation/CountingCommentBlock.php#L47-L51) и [`CountingCommentBlock::viewComments()`](src/ApplyingFinalKeyword/PreferAggregation/CountingCommentBlock.php#L56-L66) add cache capabilities. [`CountingCommentBlock::getCommentKeys()`](src/ApplyingFinalKeyword/PreferAggregation/CountingCommentBlock.php#L36-L39) is a simple single-line function that just transfers  responsibility for the execution to the nested object.

[`SimpleCommentBlock`](src/ApplyingFinalKeyword/PreferAggregation/SimpleCommentBlock.php) и [`CountingCommentBlock`](src/ApplyingFinalKeyword/PreferAggregation/CountingCommentBlock.php) maintain polymorphic behavior since both implement [`CommentBlock`](src/ApplyingFinalKeyword/PreferAggregation/CommentBlock.php) interface. Clients interacts with them transparently through the interface.

`SimpleCommentBlock` и `CountingCommentBlock` are coupled through an aggregation. For this reason they are devoid of all disadvantages of the inheritance: the base class fragility problem, the information hiding principle violation, etc. Changing the implementation detail of the base class doesn't affect the behavior and the structure of the derived class. As shown below all assertions which verify the `CountingCommentBlock` behavior are successful.

```bash
$ vendor/bin/phpunit tests/ApplyingFinalKeyword/PreferAggregation/CountingCommentBlockTest.php --testdox

ppFinal\ApplyingFinalKeyword\PreferAggregation\CountingCommentBlock
 ✔ Counts views of comment

OK (1 test, 2 assertions)
```

### A class must be prepared for the inheritance

The inheritance violates the principle of the information hiding. So it's necessary to document in PHPDoc not only a public interface but also the internal implementation details.

The [`CommentBlock::viewComment()`](src/ApplyingFinalKeyword/PreparationForInheritance/CommentBlock.php#L17-L32) is a non-final method that allows to override the implementation. Therefore [this method's PHPDoc](src/ApplyingFinalKeyword/PreparationForInheritance/CommentBlock.php#L17-28) describes the use of parameters and the existing side effects.

The [`CommentBlock::viewComments()`](src/ApplyingFinalKeyword/PreparationForInheritance/CommentBlock.php#L34-L50) is a final method however it uses the non-final method mentioned above. Overriding of the non-final `CommentBlock::viewComment()` method in the subclasses affects the behavior of the final inherited `CommentBlock::viewComments()` method. Therefore [its PHPDoc](src/ApplyingFinalKeyword/PreparationForInheritance/CommentBlock.php#L34-L42) reveals the schema of using all non-final methods.

### A class must be prepared for the aggregation

The general schema to create a loosely coupled design consists of the following steps:

1. An initial class ([`SimpleCommentBlock`](src/ApplyingFinalKeyword/PreparationForAggregation/SimpleCommentBlock.php)) is introduced into a design with the `final` keyword and the inheritance restriction.
2. To expand the functionality of the class you need to analyze the base class behavior, form its contract and to formally describe it as an interface ([`CommentBlock`](src/ApplyingFinalKeyword/PreparationForAggregation/CommentBlock.php)).
3. Introduce into a design a derived decorator class ([`CountingCommentBlock`](src/ApplyingFinalKeyword/PreparationForAggregation/CountingCommentBlock.php)) which expands the functionality of the base class and implements the same interface. An instance of the base class (`SimpleCommentBlock`) is injected into the constructor of the derived class (`CountingCommentBlock`) through the interface (`CommentBlock`).

### Using final classes in tests

Most unit test libraries use the inheritance to construct test doubles (stubs, mocks, etc). Therefore an attempt to mock the [`SimpleCommentBlock`](src/ApplyingFinalKeyword/UsingFinalClassesInTests/SimpleCommentBlock.php) final class in a [PHPUnit test](tests/ApplyingFinalKeyword/UsingFinalClassesInTests/SimpleCommentBlockTest.php#L14):

```php
$mock = $this->createMock(SimpleCommentBlock::class)
```

results in a warning like this:

```bash
$ vendor/bin/phpunit tests/ApplyingFinalKeyword/UsingFinalClassesInTests/SimpleCommentBlockTest.php --filter testCreatingTestDouble --testdox

ppFinal\ApplyingFinalKeyword\UsingFinalClassesInTests\SimpleCommentBlock
 ✘ Creating test double
   │
   │ Class "ppFinal\ApplyingFinalKeyword\UsingFinalClassesInTests\SimpleCommentBlock" is declared "final" and cannot be mocked.
   │

```

You can use two approaches to solve this problem.

- **Design approach.** The test double is another simplified dummy contract implementation. So you should [construct the test double](tests/ApplyingFinalKeyword/UsingFinalClassesInTests/CommentBlockTest.php#L11) that implements the [`CommentBlock`](src/ApplyingFinalKeyword/UsingFinalClassesInTests/CommentBlock.php) interface rather than extending [`SimpleCommentBlock`](src/ApplyingFinalKeyword/UsingFinalClassesInTests/SimpleCommentBlock.php) concrete final class.

  ```php
  $mock = $this->createMock(CommentBlock::class);
  ```

- **Magic approach.** It's used if you don't have the necessary interface to create the test double as the use of such behavior through the interface isn't provided for by business tasks. In this case you have no choice but to remove the `final` inheritance restriction.

  The first approach is to use a proxy double which contains the original test double but has no `final` restriction. You can implement it manually, but it's better to use the ready-made [Mockery](https://github.com/mockery/mockery) implementation in the [PHPUnit test](tests/ApplyingFinalKeyword/UsingFinalClassesInTests/SimpleCommentBlockTest.php#L17-L34).

  The second approach is to apply PHP magic to remove `final` keyword during loading files. Also the ready-made implementation is available as the [Bypass library](https://github.com/dg/bypass-finals). It's enough to enable removing `final` keywords in the [PHPUnit test](tests/ApplyingFinalKeyword/UsingFinalClassesInTests/SimpleCommentBlockTest.php#L36-L41) before loading a class file. 

### Tools for convenient work with final classes 

 Static analysis tools allow to find some problems in the code without actually running it. However, they can be used not only to search for typical errors, but also to control the code style. The most popular analyzer is  [PHPStan](https://github.com/phpstan/phpstan). It enables you to extend the functionality quite easily by writing custom rules. As an example you can examine and use the ready-made [`FinalRule`](https://github.com/localheinz/phpstan-rules/blob/master/src/Classes/FinalRule.php) from the unofficial third-party [`localheinz/phpstan-rules`](https://github.com/localheinz/phpstan-rules) extension. The rule must be registered as a service in the [`phpstan.neon`](phpstan.neon) configuration file. Issue  the `analyse` command and PHPStan will report an error when a non-abstract class is not `final`. 

```bash
$ vendor/bin/phpstan -lmax analyse src tests

 ------ ------------------------------------------------------------------------
  Line   src\Introduction\CommentBlock.php
 ------ ------------------------------------------------------------------------
  10     Class ppFinal\Introduction\CommentBlock is neither abstract nor final.
 ------ ------------------------------------------------------------------------

```



 