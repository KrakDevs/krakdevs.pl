module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        appDir: 'web/assets',
        builtDir: 'web/assets/compiled',

        requirejs: {
            main: {
                options: {
                    mainConfigFile: '<%= appDir %>/js/common.js',
                    appDir: '<%= appDir %>',
                    baseUrl: './js',
                    dir: '<%= builtDir %>',
                    optimizeCss: "none",
                    optimize: "none",
                    modules: [
                        {
                            name: 'common',
                            include: ['jquery', 'domReady', 'bootstrap']
                        },
                        {
                            name: 'app/main',
                            exclude: ['common']
                        },
                        {
                            name: 'app/gallery',
                            exclude: ['common']
                        }
                    ]
                }
            }
        },
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
            },
            build: {
                files: [
                    {
                        expand: true,
                        cwd: '<%= builtDir %>',
                        src: 'js/*.js',
                        dest: '<%= builtDir %>'
                    },
                    {
                        expand: true,
                        cwd: '<%= builtDir %>',
                        src: 'js/app/*.js',
                        dest: '<%= builtDir %>'
                    }
                ]
            }
        },
        jshint: {
            options: {
                reporter: require('jshint-stylish')
            },
            all: [
                'Gruntfile.js',
                '<%= appDir %>/js/{,*/}*.js'
            ]
        },
        less: {
            development: {
                files: {
                    "<%= appDir %>/css/layout.css": "<%= appDir %>/less/layout.less",
                    "<%= appDir %>/css/homepage.css": "<%= appDir %>/less/homepage.less",
                    "<%= appDir %>/css/event.css": "<%= appDir %>/less/event.less"
                }
            },
            production: {
                options: {
                    cleancss: true
                },
                files: {
                    "<%= builtDir %>/css/layout.css": "<%= appDir %>/less/layout.less",
                    "<%= appDir %>/css/homepage.css": "<%= appDir %>/less/homepage.less",
                    "<%= appDir %>/css/event.css": "<%= appDir %>/less/event.less"
                }
            }
        },
        watch: {
            less: {
                files: '<%= appDir %>/less/*.less',
                tasks: ['less:development'],
                options: {
                    spawn: false
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-requirejs');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['jshint', 'less:development']);

    grunt.registerTask('production', ['jshint', 'requirejs', 'uglify', 'less:production']);
};