# cat-php

### About
[CAT](https://github.com/dianping/cat) was created by [Frankie Wu](https://github.com/qmwu2000) and [youyong205](https://github.com/youyong205)  in [DaZhongDianPing](http://www.dianping.com) (大众点评). This copy is ***translated*** from the Java version for PHP project.

### Usage

```

function __autoload($class)
{
    $path = str_replace("\\", "/", $class);
    require_once($path . '.php');
}


class ExceptionTest
{
    function test()
    {
        throw new Exception;
    }

    public function run()
    {
        try {
            $a = test();
            echo $a;
            echo "hello, world!!!\n";
        } catch (Exception $e) {
            Cat::logError('Error', get_class($e), $e);
        }
    }
}

$test = new ExceptionTest();
$test->run();

class TransactionTest implements Demo
{
    public function run()
    {
        $transaction = Cat::newTransaction("URL", "/hello/world");

        {
            $t1 = Cat::newTransaction('Invoke', 'method1()');
            sleep(2);
            $t1->setStatus(\Message\Message::SUCCESS);
            $t1->addData("Hello", "world");
            $t1->complete();
        }

        {
            $t2 = Cat::newTransaction('Invoke', 'method2()');
            sleep(2);
            $t2->setStatus(\Message\Message::SUCCESS);
            $t2->complete();
        }

        {
            $t3 = Cat::newTransaction('Invoke', 'method3()');
            sleep(1);
            {
                $t4 = Cat::newTransaction('Invoke', 'method4()');
                sleep(2);
                $t4->setStatus(\Message\Message::SUCCESS);
                $t4->complete();
            }

            $t3->setStatus(\Message\Message::SUCCESS);
            $t3->complete();
        }

        $transaction->setStatus(\Message\Message::SUCCESS);
        $transaction->addData("Hello, world!");
        $transaction->complete();
    }
}


$test = new TransactionTest();
$test->run();

```
