<?php

namespace Oro\Bundle\MarketingListBundle\Tests\Unit\Form\Type;

use Oro\Bundle\EntityBundle\Form\Type\EntityFieldSelectType;
use Oro\Bundle\FormBundle\Form\Type\OroResizeableRichTextType;
use Oro\Bundle\MarketingListBundle\Form\Type\ContactInformationEntityChoiceType;
use Oro\Bundle\MarketingListBundle\Form\Type\MarketingListType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MarketingListTypeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var MarketingListType
     */
    protected $type;

    protected function setUp()
    {
        $this->type = new MarketingListType();
    }

    public function testBuildForm()
    {
        $builder = $this->getMockBuilder('Symfony\Component\Form\FormBuilder')
            ->disableOriginalConstructor()
            ->getMock();

        $builder->expects($this->at(0))
            ->method('add')
            ->with(
                'name',
                TextType::class,
                ['required' => true]
            )
            ->will($this->returnSelf());

        $builder->expects($this->at(1))
            ->method('add')
            ->with(
                'entity',
                ContactInformationEntityChoiceType::class,
                ['required' => true]
            )
            ->will($this->returnSelf());

        $builder->expects($this->at(2))
            ->method('add')
            ->with(
                'description',
                OroResizeableRichTextType::class,
                ['required' => false]
            )
            ->will($this->returnSelf());

        $builder->expects($this->at(4))
            ->method('add')
            ->with(
                'definition',
                HiddenType::class,
                ['required' => false]
            )
            ->will($this->returnSelf());

        $this->type->buildForm($builder, []);
    }

    public function testConfigureOptions()
    {
        $resolver = $this->createMock('Symfony\Component\OptionsResolver\OptionsResolver');
        $resolver->expects($this->once())
            ->method('setDefaults')
            ->with(
                [
                    'column_column_field_choice_options' => [
                        'exclude_fields' => ['relation_type'],
                    ],
                    'column_column_choice_type'   => HiddenType::class,
                    'filter_column_choice_type'   => EntityFieldSelectType::class,
                    'data_class'                  => 'Oro\Bundle\MarketingListBundle\Entity\MarketingList',
                    'csrf_token_id'               => 'marketing_list',
                    'query_type'                  => 'segment',
                ]
            );

        $this->type->configureOptions($resolver);
    }
}
