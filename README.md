Tests isolation with Symfony and Doctrine
=========================================

As described [there by Alexandre Salomé](http://alexandre-salome.fr/blog/Symfony2-Isolation-Of-Tests), you might want to rollback the database changes executed during your tests.

But you'll get the following error, if you want to test a Doctrine event listener in a functional test:

    Uncaught PHP Exception InvalidArgumentException: "Entity has to be managed or scheduled for removal for single computation Cheric\ExampleBundle\Entity\Article@00000000055581e0000000001ac20431" at /home/cherik/BlogIsolationTests/vendor/doctrine/orm/lib/Doctrine/ORM/UnitOfWork.php line 427

To fix this, you'll need to [use the correct EventManager in your DBAL Connection](https://github.com/ch3ric/BlogTestsIsolation/commit/2038a61e723f3091b7dd935cf3da9f3cc57651e1) when keeping the same connection between Symfony requests in your tests.
