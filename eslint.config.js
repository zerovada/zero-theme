// eslint.config.js
import wpPlugin from '@wordpress/eslint-plugin';
import wcPlugin from '@woocommerce/eslint-plugin';
import importPlugin from 'eslint-plugin-import';
import jestPlugin from 'eslint-plugin-jest';
import jsdocPlugin from 'eslint-plugin-jsdoc';
import tsParser from '@typescript-eslint/parser';
import tsPlugin from '@typescript-eslint/eslint-plugin';
import reactPlugin from 'eslint-plugin-react';

// 1) Pull only the "rules" from each shareable config:
const wpRecommendedRules    = wpPlugin.configs['recommended-with-formatting']?.rules || {};
const wpEsNextRules         = wpPlugin.configs.esnext?.rules || {};
const wcRecommendedRules    = wcPlugin.configs.recommended?.rules || {};

// 2) Merge them and add Zero overrides:
const combinedRules = {
  ...wpRecommendedRules,
  ...wpEsNextRules,
  ...wcRecommendedRules,

  // Zero theme overrides:
  'wordpress/i18n-text-domain': ['error', { allowedTextDomain: 'zero' }],
  '@wordpress/i18n-translator-comments': 'error',
  'wordpress/dependency-group': 'error',
  'no-console': 'warn',
  'no-unused-vars': ['warn', { argsIgnorePattern: '^_' }],
};

// 3) Parser options & globals:
const parserOptions = { ecmaVersion: 2021, sourceType: 'module' };
const globals = {
  window: 'readonly',
  document: 'readonly',
  jQuery: 'readonly',
  $: 'readonly',
  wp: 'readonly',
  process: 'readonly',
  require: 'readonly',
};

export default [
  // A) ignore build artifacts & vendor code
  {
    ignores: ['node_modules/**', 'assets/dist/**', 'vendor/**'],
  },

  // B) main config block
  {
    files: ['**/*.{js,jsx,ts,tsx}'],

    // Register each plugin under the exact prefix its rules use:
    plugins: {
      '@wordpress': wpPlugin,
      'wordpress': wpPlugin,
      '@woocommerce': wcPlugin,
      'import': importPlugin,
      'jest': jestPlugin,
      'jsdoc': jsdocPlugin,
      '@typescript-eslint': tsPlugin,
      'react': reactPlugin,
    },

    languageOptions: {
      parser: tsParser,      // use TS parser for both JS/TS
      parserOptions,         // ecmaVersion + sourceType
      globals,               // your read-only globals
    },

    // Tell jest-plugin which version to detect:
    settings: {
      jest: { version: 'detect' },
    },

    // All merged rules (Astra + your overrides):
    rules: combinedRules,
  },
];
