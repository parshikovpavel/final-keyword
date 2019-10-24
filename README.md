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
$ ./vendor/bin/phpunit tests/InheritanceIssues/OpenRecursionByDefault/CustomCommentBlockTest.php --testdox

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

[`CountingCommentBlock`](src/InheritanceIssues/ControlOfSideEffects/CountingCommentBlock.php) is a specific type of [`CommentBlock`](src/InheritanceIssues/ControlOfSideEffects/CommentBlock.php)  counting views of particular comments in a PSR-16 compatible cache. [`CountingCommentBlock::viewComment()`](src/InheritanceIssues/ControlOfSideEffects/CountingCommentBlock.php#35) has a side effect since increments the counter value in the cache. [`CommentBlock::viewComments()`](src/InheritanceIssues/ControlOfSideEffects/CommentBlock.php#43) combines the comment views into a single view and its implementation is inherited by `CountingCommentBlock` exactly as it is. However this inherited implementation doesn't take into account `CountingCommentBlock` responsibility for counting comment views in the cache. As a result, view counters don't work correctly during calls to `CountingCommentBlock::viewComments()`. The test result below demonstrates this thought:

```bash
$ ./vendor/bin/phpunit tests/InheritanceIssues/ControlOfSideEffects/CountingCommentBlockTest.php --testdox

ppFinal\InheritanceIssues\ControlOfSideEffects\CountingCommentBlock
 ✘ Counts views of comment
   │
   │ Failed asserting that null matches expected 1.
   │

FAILURES!
Tests: 1, Assertions: 1, Failures: 1.
```

### Base class fragility



```bash
$ ./vendor/bin/phpunit tests/InheritanceIssues/BaseClassFragility/CountingCommentBlockTest.php --testdox

ppFinal\InheritanceIssues\BaseClassFragility\CountingCommentBlock
 ✘ Counts views of comment
   │
   │ Failed asserting that 2 matches expected 1.
   │
   │

FAILURES!
Tests: 1, Assertions: 1, Failures: 1.
```

