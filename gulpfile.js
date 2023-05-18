	import gulp from 'gulp';
	import dartSass from 'sass';
	import gulpSass from 'gulp-sass';
	import postcss from 'gulp-postcss';
	import sourcemaps from 'gulp-sourcemaps';
	import autoprefixer from 'autoprefixer';
	import cssnano from 'cssnano';
	import imagemin, {gifsicle, mozjpeg, optipng, svgo} from 'gulp-imagemin';
	import browserSync from 'browser-sync';
	const sass = gulpSass( dartSass );
	const server = browserSync.create();
	const localHost = 'http://localhost:8000/';

/**
 * Define all source paths
 */

var paths = {
	styles: {
		src: './source/css/*.scss',
		dest: './css/'
	},
	scripts: {
		src: './source/js/*.js',
		dest: './js/'
	},
	php: {
		src: './source/php/*.php',
		dest: './'
	},
	img: {
		src: './source/img/**/*.{gif,jpg,jpeg,png,svg}',
		dest: './img/'
	}
};

function build_php() {
	return gulp.src( paths.php.src )
		.pipe(
			gulp.dest( paths.php.dest )
		)
		.pipe(
			server.stream() // Browser Reload
		);
}


/**
 * Webpack compilation: https://webpack.js.org, https://github.com/shama/webpack-stream#usage-with-gulp-watch
 * 
 * build_js()
 */

function build_js() {
	const compiler = require( 'webpack' ),
		webpackStream = require( 'webpack-stream' );
	
	return gulp.src( paths.scripts.src )
		.pipe(
			webpackStream( {
				config: require( './webpack.config.js' )
				},
				compiler
			)
		)
		.pipe(
			gulp.dest( paths.scripts.dest )
		)
		.pipe(
			server.stream() // Browser Reload
		);
}


/**
 * SASS-CSS compilation: https://www.npmjs.com/package/gulp-sass
 * 
 * build_css()
 */

function build_css() {
	const plugins = [
		autoprefixer(),
		cssnano(),
	];

	return gulp.src( paths.styles.src )
		.pipe(
			sourcemaps.init()
		)
		.pipe(
			sass( {
				includePaths: [ './node_modules' ]
			} )
				.on( 'error', sass.logError )
		)
		.pipe(
			postcss( plugins )
		)
		.pipe(
			sourcemaps.write( './' )
		)
		.pipe(
			gulp.dest( paths.styles.dest )
		)
		.pipe(
			server.stream() // Browser Reload
		);
}

function minify_img() {
	return gulp.src( paths.img.src )
	.pipe(
		imagemin(
			[
				gifsicle( {interlaced: true} ),
				mozjpeg( {quality: 75, progressive: true} ),
				optipng( {optimizationLevel: 5} ),
				svgo( {
					plugins: [
						{
							name: 'removeViewBox',
							active: true
						},
						{
							name: 'cleanupIDs',
							active: false
						}
					]
				} )
			]
		) 
	)
	.pipe(
		gulp.dest( paths.img.dest )
		)
	.pipe(
		server.stream() // Browser Reload
	);
}


/**
 * Watch task: Webpack + SASS
 * 
 * $ gulp default
 */

gulp.task( 'default',
	function () {
		// Modify "localHost" constant and uncomment "server.init()" to use browser sync
		server.init({
			proxy: localHost,
		} );
		
		gulp.watch( paths.scripts.src, build_js );
		gulp.watch( [ paths.styles.src, './source/css/*.scss' ], build_css );
		gulp.watch( paths.php.src, build_php );
		gulp.watch( paths.img.src, minify_img );
	}
);

gulp.task( 'build',
	function () {
		// Modify "localHost" constant and uncomment "server.init()" to use browser sync
		/*server.init({
			proxy: localHost,
		} );*/

		gulp.build( paths.scripts.src, build_js );
		gulp.build( [ paths.styles.src, './source/css/*.scss' ], build_css );
		gulp.watch( paths.php.src, build_php );
		gulp.watch( paths.img.src, minify_img );
	}
);

  // export default gulp.default;
  // export function gulp.build;