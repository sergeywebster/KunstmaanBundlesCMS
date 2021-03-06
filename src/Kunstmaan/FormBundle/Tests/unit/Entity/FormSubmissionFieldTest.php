<?php

namespace Kunstmaan\FormBundle\Tests\Entity;

use Kunstmaan\FormBundle\Entity\FormSubmission;
use Kunstmaan\FormBundle\Entity\FormSubmissionField;
use Kunstmaan\FormBundle\Entity\FormSubmissionFieldTypes\StringFormSubmissionField;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Request;

class Plain extends FormSubmissionField
{
}

class FormSubmissionFieldTest extends TestCase
{
    /**
     * @var StringFormSubmissionField
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new StringFormSubmissionField();
    }

    public function testSetGetId()
    {
        $object = $this->object;
        $id = 123;
        $object->setId($id);
        $this->assertEquals($id, $object->getId());
    }

    public function testSetGetFieldName()
    {
        $object = $this->object;
        $fieldName = 'someFieldName';
        $object->setFieldName($fieldName);
        $this->assertEquals($fieldName, $object->getFieldName());
    }

    public function testSetGetLabel()
    {
        $object = $this->object;
        $label = 'Some label';
        $object->setLabel($label);
        $this->assertEquals($label, $object->getLabel());
    }

    public function testSetGetSequence()
    {
        $object = $this->object;
        $label = 'Some label';
        $object->setSequence($label);
        $this->assertEquals($label, $object->getSequence());
    }

    public function testOnValidPost()
    {
        $object = $this->object;
        $form = $this->getMockBuilder(Form::class)
            ->disableOriginalConstructor()
            ->getMock();

        $builder = $this->getMockBuilder(FormBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $request = new Request();

        $container = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $container->expects($this->any())
            ->method('getParameter')
            ->will($this->returnValue('whatever'));

        $object->onValidPost($form, $builder, $request, $container);
    }

    public function testSetGetSubmission()
    {
        $object = $this->object;
        $submission = new FormSubmission();
        $submission->setId(123);
        $object->setSubmission($submission);
        $retrievedSubmission = $object->getSubmission();
        $this->assertEquals($submission, $retrievedSubmission);
        $this->assertEquals($submission->getId(), $retrievedSubmission->getId());
    }

    public function testToString()
    {
        $plainObject = new Plain();
        $stringValue = $plainObject->__toString();
        $this->assertEquals('FormSubmission Field', $stringValue);
    }
}
