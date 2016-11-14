var gulp = require("gulp"),
    webpack = require("webpack"),
    arg = require('yargs').argv;


gulp.task("webpack", function(callback) {
    webpack({
            entry: `./js/app.js`,
            
            output: {
                path: "./../",
                filename: `script.js`
            },

            cache: true,
            //watch: true,

            //devtool: 'eval',
            //devtool: 'source-map',

            plugins: [
                new webpack.optimize.UglifyJsPlugin({minimize: true})
            ],

            module: {
               loaders: [
                    {
                        test: /\.jsx?$/,
                        exclude: /(node_modules|bower_components)/,
                        loader: 'babel',
                        query: {
                            presets: ['es2015', 'stage-0']
                        }
                    }
                ] 
            }
        
    }, function(err, stats) {
        if(err) throw new gutil.PluginError("webpack", err);
        console.log("[webpack]", stats.toString({
            // output options
        }));
        callback();
    });
});