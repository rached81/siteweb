// const Encore = require('@symfony/webpack-encore');
//
// if (!Encore.isRuntimeEnvironmentConfigured()) {
//     Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
// }
//
// Encore
//     // directory where compiled assets will be stored
//     .setOutputPath('public/build/')
//     .setPublicPath('/build')
//
//     .addEntry('app', './assets/app.js')
//     .enableStimulusBridge('./assets/controllers.json')
//     .splitEntryChunks()
//     .enableSingleRuntimeChunk()
//     .cleanupOutputBeforeBuild()
//     .enableBuildNotifications()
//     .enableSourceMaps(!Encore.isProduction())
//     .enableVersioning(Encore.isProduction())
//     .configureBabel((config) => {
//         config.plugins.push('@babel/plugin-proposal-class-properties');
//     })
//     .configureBabelPresetEnv((config) => {
//         config.useBuiltIns = 'usage';
//         config.corejs = 3;
//     })
//     .enableSassLoader()
//     .autoProvidejQuery()
// ;
//
// module.exports = Encore.getWebpackConfig();
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
                test: /\.svg$/,
                use: ['raw-loader']
            },
            {
                test: /\.css$/,
                use: ['style-loader', 'css-loader']
            }
        ]
    }
};
