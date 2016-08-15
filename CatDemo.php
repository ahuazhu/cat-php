<?php
use Message\Message;

/**
 * @author: ahuazhu@gmail.com
 * Date: 16/7/19  下午2:23
 */

function __autoload($class)
{
    $path = str_replace("\\", "/", $class);
    require_once($path . '.php');
}


class ExceptionTest
{
    function methodThrowsException()
    {
        throw new Exception;
    }

    public function run()
    {
        try {
            $a = $this->methodThrowsException();
            echo $a;
            echo "hello, world!!!\n";
        } catch (Exception $e) {
            Cat::logError('Error', get_class($e), $e);
        }
    }
}


//$test = new ExceptionTest();
//$test->run();

class TransactionTest
{
    public function run()
    {
        $transaction = Cat::newTransaction("URL", "/hello/world");

        {
            $t1 = Cat::newTransaction('Invoke', 'method1()');
            sleep(2);
            $t1->setStatus(Message::SUCCESS);
            $t1->addData("Hello", "world");
            $t1->complete();
        }

        {
            $t2 = Cat::newTransaction('Invoke', 'method2()');
            sleep(2);
            $t2->setStatus(Message::SUCCESS);
            $t2->complete();
        }

        {
            $t3 = Cat::newTransaction('Invoke', 'method3()');
            sleep(1);
            {
                $t4 = Cat::newTransaction('Invoke', 'method4()');
                sleep(2);
                $t4->setStatus(Message::SUCCESS);
                $t4->complete();
            }

            $t3->setStatus(Message::SUCCESS);
            $t3->complete();
        }

        $transaction->setStatus(Message::SUCCESS);
        $transaction->addData("Hello, world!");
        $transaction->complete();
    }
}

class MetricDemo
{
    public function run()
    {
        Cat::logMetricForCount("Amount");

    }
}

$metricTest = new MetricDemo();

$metricTest->run();

//
//$test = new TransactionTest();
//$test->run();
