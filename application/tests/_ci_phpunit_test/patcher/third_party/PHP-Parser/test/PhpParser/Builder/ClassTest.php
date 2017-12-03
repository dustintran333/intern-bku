<?php

namespace PhpParser\Builder;

use PhpParser\Comment;
use PhpParser\Node;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt;

class ClassTest extends \PHPUnit_Framework_TestCase
{
    protected function createClassBuilder($class) {
        return new Class_($class);
    }

    public function testExtendsImplements() {
        $node = $this->createClassBuilder('SomeLogger')
            ->extend('BaseLogger')
            ->implement('Namespaced\Logger', new Name('SomeInterface'))
            ->implement('\Fully\Qualified', 'namespace\NamespaceRelative')
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\Class_('SomeLogger', array(
                'extends' => new Name('BaseLogger'),
                'implements' => array(
                    new Name('Namespaced\Logger'),
                    new Name('SomeInterface'),
                    new Name\FullyQualified('Fully\Qualified'),
                    new Name\Relative('NamespaceRelative'),
                ),
            )),
            $node
        );
    }

    public function testAbstract() {
        $node = $this->createClassBuilder('Login')
            ->makeAbstract()
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\Class_('Login', array(
                'type' => Stmt\Class_::MODIFIER_ABSTRACT
            )),
            $node
        );
    }

    public function testFinal() {
        $node = $this->createClassBuilder('Login')
            ->makeFinal()
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\Class_('Login', array(
                'type' => Stmt\Class_::MODIFIER_FINAL
            )),
            $node
        );
    }

    public function testStatementOrder() {
        $method = new Stmt\ClassMethod('testMethod');
        $property = new Stmt\Property(
            Stmt\Class_::MODIFIER_PUBLIC,
            array(new Stmt\PropertyProperty('testProperty'))
        );
        $const = new Stmt\ClassConst(array(
            new Node\Const_('TEST_CONST', new Node\Scalar\String_('ABC'))
        ));
        $use = new Stmt\TraitUse(array(new Name('SomeTrait')));

        $node = $this->createClassBuilder('Login')
            ->addStmt($method)
            ->addStmt($property)
            ->addStmts(array($const, $use))
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\Class_('Login', array(
                'stmts' => array($use, $const, $property, $method)
            )),
            $node
        );
    }

    public function testDocComment() {
        $docComment = <<<'DOC'
/**
 * Test
 */
DOC;
        $class = $this->createClassBuilder('Login')
            ->setDocComment($docComment)
            ->getNode();

        $this->assertEquals(
            new Stmt\Class_('Login', array(), array(
                'comments' => array(
                    new Comment\Doc($docComment)
                )
            )),
            $class
        );

        $class = $this->createClassBuilder('Login')
            ->setDocComment(new Comment\Doc($docComment))
            ->getNode();

        $this->assertEquals(
            new Stmt\Class_('Login', array(), array(
                'comments' => array(
                    new Comment\Doc($docComment)
                )
            )),
            $class
        );
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Unexpected node of type "Stmt_Echo"
     */
    public function testInvalidStmtError() {
        $this->createClassBuilder('Login')
            ->addStmt(new Stmt\Echo_(array()))
        ;
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Doc comment must be a string or an instance of PhpParser\Comment\Doc
     */
    public function testInvalidDocComment() {
        $this->createClassBuilder('Login')
            ->setDocComment(new Comment('Login'));
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Name cannot be empty
     */
    public function testEmptyName() {
        $this->createClassBuilder('Login')
            ->extend('');
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Name must be a string or an instance of PhpParser\Node\Name
     */
    public function testInvalidName() {
        $this->createClassBuilder('Login')
            ->extend(array('Foo'));
    }
}
