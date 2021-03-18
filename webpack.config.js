const path = require('path');

module.exports = {
    resolve: {
        alias: {
            '@': path.resolve('resources/js/components'),
            'vue$': 'vue/dist/vue.esm.js'
        },
    },
};
