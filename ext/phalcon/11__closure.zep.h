
extern zend_class_entry *phalcon_11__closure_ce;

ZEPHIR_INIT_CLASS(phalcon_11__closure);

PHP_METHOD(phalcon_11__closure, __invoke);

ZEND_BEGIN_ARG_INFO_EX(arginfo_phalcon_11__closure___invoke, 0, 0, 1)
	ZEND_ARG_INFO(0, escaper)
ZEND_END_ARG_INFO()

ZEPHIR_INIT_FUNCS(phalcon_11__closure_method_entry) {
	PHP_ME(phalcon_11__closure, __invoke, arginfo_phalcon_11__closure___invoke, ZEND_ACC_PUBLIC|ZEND_ACC_FINAL)
	PHP_FE_END
};
