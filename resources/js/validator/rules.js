import {extend, localize} from "vee-validate";
import * as rules from 'vee-validate/dist/rules';
import en from 'vee-validate/dist/locale/en.json';

extend('min', rules['min']);
extend('max', rules['max']);
extend('regex', rules['regex']);
extend('required', rules['required']);
extend('email', rules['email']);
extend('confirmed', rules['confirmed']);
extend('string', (value) => typeof value === 'string')
localize('en', en);

export default {};
