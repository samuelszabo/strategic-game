const path = require('path');
const ManifestPlugin = require('webpack-manifest-plugin');
const {CleanWebpackPlugin} = require('clean-webpack-plugin');

const config = {
    mode: 'development',
    entry: './js/index.js',
    optimization: {
        splitChunks: {
            chunks: 'all',
        },
    },
    output: {
        path: path.resolve(__dirname, 'webroot/js/'),
        filename: '[name].js',
        chunkFilename: '[name].js',
    },
    plugins: [
        // new ManifestPlugin(),
        new CleanWebpackPlugin({
            protectWebpackAssets: true,
        }),
    ],
};

module.exports = (env, argv) => {
    if (argv.mode === 'development') {
        console.log('je DEV');
        config.devtool = 'inline-source-map';
    } else {
        console.log('je PROD');
        config.plugins.push(new ManifestPlugin());
        config.output.filename = '[name]-[hash].js';
        config.output.chunkFilename = '[name]-[hash].js';
    }
    return config;
};
