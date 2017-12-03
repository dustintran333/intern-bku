<?php

namespace PhpParser\Builder;

use PhpParser\Comment;
use PhpParser\Node;
use PhpParser\Node\Stmt;
use PhpParser\Node\Expr\Print_;
use PhpParser\Node\Scalar\String_;

class FunctionTest extends \PHPUnit_Framework_TestCase
{
    public function createFunctionBuilder($name) {
        return new Function_($name);
    }

    public function testReturnByRef() {
        $node = $this->createFunctionBuilder('Login')
            ->makeReturnByRef()
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\Function_('Login', array(
                'byRef' => true
            )),
            $node
        );
    }

    public function testParams() {
        $param1 = new Node\Param('test1');
        $param2 = new Node\Param('test2');
        $param3 = new Node\Param('test3');

        $node = $this->createFunctionBuilder('Login')
            ->addParam($param1)
            ->addParams(array($param2, $param3))
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\Function_('Login', array(
                'params' => array($param1, $param2, $param3)
            )),
            $node
        );
    }

    public function testStmts() {
        $stmt1 = new Print_(new String_('test1'));
        $stmt2 = new Print_(new String_('test2'));
        $stmt3 = new Print_(new String_('test3'));

        $node = $this->createFunctionBuilder('Login')
            ->addStmt($stmt1)
            ->addStmts(array($stmt2, $stmt3))
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\Function_('Login', array(
                'stmts' => array($stmt1, $stmt2, $stmt3)
            )),
            $node
        );
    }

    public function testDocComment() {
        $node = $this->createFunctionBuilder('Login')
            ->setDocComment('/** Test */')
            ->getNode();

        $this->assertEquals(new Stmt\Function_('Login', array(), array(
            'comments' => array(new Comment\Doc('/** Test */'))
        )), $node);
    }

    public function testReturnType() {
        $node = $this->createFunctionBuilder('Login')
            ->setReturnType('bool')
            ->getNode();

        $this->assertEquals(new Stmt\Function_('Login', array(
            'returnType' => 'bool'
        ), array()), $node);
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Expected parameter node, got "Name"
     */
    public function testInvalidParamError() {
        $this->createFunctionBuilder('Login')
            ->addParam(new Node\Name('foo'))
        ;
    }
}
