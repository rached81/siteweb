const path = require('path');

module.exports = {
    entry: './src/ckeditor.js',

    output: {
        path: path.resolve(__dirname, 'build'),
        filename: 'ckeditor.js',
        library: 'ClassicEditor',
        libraryTarget: 'umd',
        clean: true
    },

    mode: 'production',

    module: {
        rules: [
            {
                test: /\.m?js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        sourceType: 'unambiguous'
                    }
                }
            },
            {
                test: /\.svg$/,
                use: ['raw-loader']
            },
            {
                test: /\.css$/,
                use: ['style-loader', 'css-loader']
            }
        ]
    },

    resolve: {
        extensions: ['.js']
    }
};
