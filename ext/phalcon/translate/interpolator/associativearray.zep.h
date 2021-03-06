
extern zend_class_entry *phalcon_translate_interpolator_associativearray_ce;

ZEPHIR_INIT_CLASS(Phalcon_Translate_Interpolator_AssociativeArray);

PHP_METHOD(Phalcon_Translate_Interpolator_AssociativeArray, replacePlaceholders);

#if PHP_VERSION_ID >= 70200
ZEND_BEGIN_ARG_WITH_RETURN_TYPE_INFO_EX(arginfo_phalcon_translate_interpolator_associativearray_replaceplaceholders, 0, 1, IS_STRING, 0)
#else
ZEND_BEGIN_ARG_WITH_RETURN_TYPE_INFO_EX(arginfo_phalcon_translate_interpolator_associativearray_replaceplaceholders, 0, 1, IS_STRING, NULL, 0)
#endif
#if PHP_VERSION_ID >= 70200
	ZEND_ARG_TYPE_INFO(0, translation, IS_STRING, 0)
#else
	ZEND_ARG_INFO(0, translation)
#endif
	ZEND_ARG_INFO(0, placeholders)
ZEND_END_ARG_INFO()

ZEPHIR_INIT_FUNCS(phalcon_translate_interpolator_associativearray_method_entry) {
	PHP_ME(Phalcon_Translate_Interpolator_AssociativeArray, replacePlaceholders, arginfo_phalcon_translate_interpolator_associativearray_replaceplaceholders, ZEND_ACC_PUBLIC)
	PHP_FE_END
};
