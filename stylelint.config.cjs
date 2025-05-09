// stylelint.config.cjs
module.exports = {
  // 1. Parse SCSS syntax correctly
  customSyntax: 'postcss-scss',

  // 2. Base shareable config for SCSS + standard rules
  extends: 'stylelint-config-standard-scss',

  // 3. Plugins for SCSS features and property ordering
  plugins: [
    'stylelint-scss',
    'stylelint-order',
  ],

  rules: {
    // SCSS at-rules
    'at-rule-no-unknown': null,
    'scss/at-rule-no-unknown': true,

    // Basic block & declaration rules
    'block-no-empty': true,
    'declaration-block-trailing-semicolon': 'always',
    'declaration-colon-space-after': 'always',
    'declaration-block-single-line-max-declarations': [1, {
      ignore: ['after-comment']
    }],

    // Whitespace & formatting
    'indentation': 2,
    'max-empty-lines': 1,
    'number-leading-zero': 'always',
    'string-quotes': 'single',

    // Comments spacing
    'comment-empty-line-before': ['always', {
      ignore: ['after-comment', 'stylelint-commands'],
    }],

    // Rule-level spacing
    'rule-empty-line-before': ['always', {
      except: ['first-nested'],
      ignore: ['after-comment'],
    }],

    // Property ordering (Astra-style groups)
    'order/properties-order': [
      [
        {
          groupName: 'Variables',
          emptyLineBefore: 'always',
          properties: [
            '$primary-color',
            '$secondary-color',
            '$text-color',
            '$bg-color',
            '$font-family-base',
            '$font-size-base',
            '$spacing-unit',
          ],
        },
        {
          groupName: 'Positioning',
          emptyLineBefore: 'always',
          properties: [
            'position',
            'top',
            'right',
            'bottom',
            'left',
            'z-index',
          ],
        },
        {
          groupName: 'Box Model',
          emptyLineBefore: 'always',
          properties: [
            'display',
            'flex',
            'flex-basis',
            'flex-direction',
            'flex-wrap',
            'justify-content',
            'align-items',
            'width',
            'height',
            'margin',
            'padding',
            'border',
            'border-radius',
          ],
        },
        {
          groupName: 'Typography',
          emptyLineBefore: 'always',
          properties: [
            'font',
            'font-family',
            'font-size',
            'font-weight',
            'line-height',
            'text-align',
            'color',
          ],
        },
        {
          groupName: 'Visual',
          emptyLineBefore: 'always',
          properties: [
            'background',
            'background-color',
            'box-shadow',
          ],
        },
      ],
      {
        unspecified: 'bottomAlphabetical',
      },
    ],
  },
};
