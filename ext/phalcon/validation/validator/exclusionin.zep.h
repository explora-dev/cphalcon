
extern zend_class_entry *phalcon_validation_validator_exclusionin_ce;

ZEPHIR_INIT_CLASS(Phalcon_Validation_Validator_ExclusionIn);

PHP_METHOD(Phalcon_Validation_Validator_ExclusionIn, validate);

#if PHP_VERSION_ID >= 70200
ZEND_BEGIN_ARG_WITH_RETURN_TYPE_INFO_EX(arginfo_phalcon_validation_validator_exclusionin_validate, 0, 2, _IS_BOOL, 0)
#else
ZEND_BEGIN_ARG_WITH_RETURN_TYPE_INFO_EX(arginfo_phalcon_validation_validator_exclusionin_validate, 0, 2, _IS_BOOL, NULL, 0)
#endif
	ZEND_ARG_OBJ_INFO(0, validation, Phalcon\\Validation, 0)
	ZEND_ARG_INFO(0, field)
ZEND_END_ARG_INFO()

ZEPHIR_INIT_FUNCS(phalcon_validation_validator_exclusionin_method_entry) {
	PHP_ME(Phalcon_Validation_Validator_ExclusionIn, validate, arginfo_phalcon_validation_validator_exclusionin_validate, ZEND_ACC_PUBLIC)
	PHP_FE_END
};
