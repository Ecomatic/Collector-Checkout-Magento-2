<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Collector\Gateways\Model\Total;


class Fee extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
{
   /**
	 * Collect grand total address amount
	 *
	 * @param \Magento\Quote\Model\Quote $quote
	 * @param \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment
	 * @param \Magento\Quote\Model\Quote\Address\Total $total
	 * @return $this
	 */
	protected $quoteValidator = null; 

	public function __construct(\Magento\Quote\Model\QuoteValidator $quoteValidator){
		$this->quoteValidator = $quoteValidator;
	}
	
	public function collect(
		\Magento\Quote\Model\Quote $quote,
		\Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
		\Magento\Quote\Model\Quote\Address\Total $total
	) {
		parent::collect($quote, $shippingAssignment, $total);

		$exist_amount = $quote->getFee(); 
		$fee = 0;
		if (is_null($quote->getShippingAddress()->getCity())){
			$fee = 0;
		}
		else {
			$storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
			if (isset($_SESSION['btype'])){
				if ($_SESSION['btype'] == 'b2b'){
					$fee = floatval(\Magento\Framework\App\ObjectManager::getInstance()->get('\Magento\Framework\App\Config\ScopeConfigInterface')->getValue('collector_collectorcheckout/invoice/invoice_fee_b2b', $storeScope));
				}
				else {
					$fee = floatval(\Magento\Framework\App\ObjectManager::getInstance()->get('\Magento\Framework\App\Config\ScopeConfigInterface')->getValue('collector_collectorcheckout/invoice/invoice_fee_b2c', $storeScope));
				}
			}
			else {
				$fee = floatval(\Magento\Framework\App\ObjectManager::getInstance()->get('\Magento\Framework\App\Config\ScopeConfigInterface')->getValue('collector_collectorcheckout/invoice/invoice_fee_b2c', $storeScope));
			}
		}
		
		$balance = $fee - $exist_amount;

	/*	$total->setTotalAmount('fee', $balance);
		$total->setBaseTotalAmount('fee', $balance);

	/*	$total->setFee($balance);
		$total->setBaseFee($balance);*/

	/*	$total->setGrandTotal($total->getGrandTotal() + $balance);
		$total->setBaseGrandTotal($total->getBaseGrandTotal() + $balance);*/

		return $this;
	} 

	protected function clearValues(Address\Total $total)
	{
		$total->setTotalAmount('subtotal', 0);
		$total->setBaseTotalAmount('subtotal', 0);
		$total->setTotalAmount('tax', 0);
		$total->setBaseTotalAmount('tax', 0);
		$total->setTotalAmount('discount_tax_compensation', 0);
		$total->setBaseTotalAmount('discount_tax_compensation', 0);
		$total->setTotalAmount('shipping_discount_tax_compensation', 0);
		$total->setBaseTotalAmount('shipping_discount_tax_compensation', 0);
		$total->setSubtotalInclTax(0);
		$total->setBaseSubtotalInclTax(0);
		$total->setFee(0);
		$total->setBaseFee(0);
	}
	/**
	 * @param \Magento\Quote\Model\Quote $quote
	 * @param Address\Total $total
	 * @return array|null
	 */
	/**
	 * Assign subtotal amount and label to address object
	 *
	 * @param \Magento\Quote\Model\Quote $quote
	 * @param Address\Total $total
	 * @return array
	 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
	 */
	public function fetch(\Magento\Quote\Model\Quote $quote, \Magento\Quote\Model\Quote\Address\Total $total){
		if (is_null($quote->getShippingAddress()->getCity())){
			return [
				'code' => 'fee',
				'title' => 'Fee',
				'value' => 0
			];
		}
		else {
			$storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
			if (isset($_SESSION['btype'])){
				if ($_SESSION['btype'] == 'b2b'){
					return [
						'code' => 'fee',
						'title' => 'Fee',
						'value' => floatval(\Magento\Framework\App\ObjectManager::getInstance()->get('\Magento\Framework\App\Config\ScopeConfigInterface')->getValue('collector_collectorcheckout/invoice/invoice_fee_b2b', $storeScope))
					];
				}
				else {
					return [
						'code' => 'fee',
						'title' => 'Fee',
						'value' => floatval(\Magento\Framework\App\ObjectManager::getInstance()->get('\Magento\Framework\App\Config\ScopeConfigInterface')->getValue('collector_collectorcheckout/invoice/invoice_fee_b2c', $storeScope))
					];
				}
			}
			else {
				return [
					'code' => 'fee',
					'title' => 'Fee',
					'value' => floatval(\Magento\Framework\App\ObjectManager::getInstance()->get('\Magento\Framework\App\Config\ScopeConfigInterface')->getValue('collector_collectorcheckout/invoice/invoice_fee_b2c', $storeScope))
				];
			}
		}
		
	}

	/**
	 * Get Subtotal label
	 *
	 * @return \Magento\Framework\Phrase
	 */
	public function getLabel(){
		return __('Fee');
	}
}