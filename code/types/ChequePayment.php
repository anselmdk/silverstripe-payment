<?php

/**
 * Payment object representing a cheque payment.
 * 
 * @package payment
 */
class ChequePayment extends Payment {
	
	/**
	 * Process the Cheque payment method
	 */
	function processPayment($data, $form) {
		$this->Status = 'Pending';
		$this->Message = '<p class="warningMessage">' . _t('ChequePayment.MESSAGE', 'Payment accepted via Cheque. Please note : products will not be shipped until payment has been received.') . '</p>';
		
		$this->write();
		return new Payment_Success();
	}
	
	function getPaymentFormFields() {
		return new FieldSet(
			// retrieve cheque content from the ChequeContent() method on this class
			new LiteralField("Chequeblurb", '<div id="Cheque" class="typography">' . _t('ChequePayment.CONTENT','Please note: Your goods will not be dispatched until we receive your payment.') . '</div>'),
			new HiddenField("Cheque", "Cheque", 0)
		);
	}
	
	function getPaymentFormRequirements() {
		return null;
	}

	/**
	 * Returns the Cheque content from the CheckoutPage
	 */
	function ChequeContent() {
		return _t('ChequePayment.CONTENT','Please note: Your goods will not be dispatched until we receive your payment.');
	}
	
}