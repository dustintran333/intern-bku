<?php

namespace PhpParser\Builder;

use PhpParser\Node;
use PhpParser\Node\Expr\Print_;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt;
use PhpParser\Comment;

class MethodTest extends \PHPUnit_Framework_TestCase
{
    public function createMethodBuilder($name) {
        return new Method($name);
    }

    public function testModifiers() {
        $node = $this->createMethodBuilder('Login')
            ->makePublic()
            ->makeAbstract()
            ->makeStatic()
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\ClassMethod('Login', array(
                'type' => Stmt\Class_::MODIFIER_PUBLIC
                        | Stmt\Class_::MODIFIER_ABSTRACT
                        | Stmt\Class_::MODIFIER_STATIC,
                'stmts' => null,
            )),
            $node
        );

        $node = $this->createMethodBuilder('Login')
            ->makeProtected()
            ->makeFinal()
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\ClassMethod('Login', array(
                'type' => Stmt\Class_::MODIFIER_PROTECTED
                        | Stmt\Class_::MODIFIER_FINAL
            )),
            $node
        );

        $node = $this->createMethodBuilder('Login')
            ->makePrivate()
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\ClassMethod('Login', array(
                'type' => Stmt\Class_::MODIFIER_PRIVATE
            )),
            $node
        );
    }

    public function testReturnByRef() {
        $node = $this->createMethodBuilder('Login')
            ->makeReturnByRef()
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\ClassMethod('Login', array(
                'byRef' => true
            )),
            $node
        );
    }

    public function testParams() {
        $param1 = new Node\Param('test1');
        $param2 = new Node\Param('test2');
        $param3 = new Node\Param('test3');

        $node = $this->createMethodBuilder('Login')
            ->addParam($param1)
            ->addParams(array($param2, $param3))
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\ClassMethod('Login', array(
                'params' => array($param1, $param2, $param3)
            )),
            $node
        );
    }

    public function testStmts() {
        $stmt1 = new Print_(new String_('test1'));
        $stmt2 = new Print_(new String_('test2'));
        $stmt3 = new Print_(new String_('test3'));

        $node = $this->createMethodBuilder('Login')
            ->addStmt($stmt1)
            ->addStmts(array($stmt2, $stmt3))
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\ClassMethod('Login', array(
                'stmts' => array($stmt1, $stmt2, $stmt3)
            )),
            $node
        );
    }
    public function testDocComment() {
        $node = $this->createMethodBuilder('Login')
            ->setDocComment('/** Test */')
            ->getNode();

        $this->assertEquals(new Stmt\ClassMethod('Login', array(), array(
            'comments' => array(new Comment\Doc('/** Test */'))
        )), $node);
    }

    public function testReturnType() {
        $node = $this->createMethodBuilder('Login')
            ->setReturnType('bool')
            ->getNode();
        $this->assertEquals(new Stmt\ClassMethod('Login', array(
            'returnType' => 'bool'
        ), array()), $node);
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Cannot add statements to an abstract method
     */
    public function testAddStmtToAbstractMethodError() {
        $this->createMethodBuilder('Login')
            ->makeAbstract()
            ->addStmt(new Print_(new String_('Login')))
        ;
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Cannot make method with statements abstract
     */
    public function testMakeMethodWithStmtsAbstractError() {
        $this->createMethodBuilder('Login')
            ->addStmt(new Print_(new String_('Login')))
            ->makeAbstract()
        ;
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Expected parameter node, got "Name"
     */
    public function testInvalidParamError() {
        $this->createMethodBuilder('Login')
            ->addParam(new Node\Name('foo'))
        ;
    }
}
