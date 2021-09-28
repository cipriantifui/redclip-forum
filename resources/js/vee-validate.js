import { extend } from "vee-validate";
import { required } from "vee-validate/dist/rules";
import * as rules from 'vee-validate/dist/rules';
import { messages } from 'vee-validate/dist/locale/en.json';

Object.keys(rules).forEach(rule => {
    extend(rule, {
        ...rules[rule], // copies rule configuration
        message: messages[rule] // assign message
    });
});

//Override the default message.
extend('required', {
  ...required,
  message: 'This field is required'
});
