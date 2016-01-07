<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\CartBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
class CartItemTypeSpec extends ObjectBehavior
{
    function let(DataMapperInterface $orderItemQuantityDataMapper)
    {
        $this->beConstructedWith('CartItem', array('sylius'), $orderItemQuantityDataMapper);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\CartBundle\Form\Type\CartItemType');
    }

    function it_is_a_form_type()
    {
        $this->shouldImplement(FormTypeInterface::class);
    }

    function it_builds_form_with_quantity_field($orderItemQuantityDataMapper, FormBuilder $builder)
    {
        $builder
            ->add('quantity', 'integer', Argument::any())
            ->willReturn($builder)
            ->shouldBeCalled()
        ;

        $builder
            ->setDataMapper($orderItemQuantityDataMapper)
            ->willReturn($builder)
            ->shouldBeCalled()
        ;

        $this->buildForm($builder, array());
    }

    function it_defines_assigned_data_class(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(array(
                'data_class'        => 'CartItem',
                'validation_groups' => array('sylius'),
            ))
            ->shouldBeCalled()
        ;

        $this->configureOptions($resolver);
    }
}
