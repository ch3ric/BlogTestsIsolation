Tests isolation with Symfony and Doctrine
=========================================

As described here, you might want to rollback the database changes executed during your tests:
[http://alexandre-salome.fr/blog/Symfony2-Isolation-Of-Tests|http://alexandre-salome.fr/blog/Symfony2-Isolation-Of-Tests]

But you'll get the following error, if you want to test a Doctrine event listener in a functional test:

    Uncaught PHP Exception InvalidArgumentException: "Entity has to be managed or scheduled for removal for single computation Cheric\ExampleBundle\Entity\Article@00000000055581e0000000001ac20431" at /home/cherik/BlogIsolationTests/vendor/doctrine/orm/lib/Doctrine/ORM/UnitOfWork.php line 427