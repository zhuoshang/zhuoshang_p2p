module.exports = function (grunt) {
    grunt.initConfig({
        compass: {
            options: {
                cssDir: "css/",
                sassDir: "sass/",
                imagesDir: "images/",
                javascriptDir: "js/",
                fontsDir: "fonts/",
                outputStyle: "compressed",
                specify: ["sass/*.scss", "!sass/common/*.scss"]
            },
            main: {
                files: [
                    {
                        expand: true,
                        cwd: "sass/",
                        src: ["*.scss"]
                    }
                ]
            }
        },
        browserify: {
            main: {
               /* files: {
                    "js/index.min.js": ["js/index.js"]
                }*/
                files: [
                    {
                        expand: true,
                        cwd: "js/",
                        src: ["**/*.js", "!lib/*.js"],
                        dest: "js/",
                        ext: ".min.js"
                    }
                ]
            }
        },
        clean: {
            main: {
                files: [
                    {
                        expand: true,
                        cwd: "js/",
                        src: ["*.min.js"]
                    }
                ]
            }
        },
        watch: {
            css: {
                files: ["sass/*.scss"],
                tasks: ["compass"]
            },
            js: {
                files: ["js/*.js", "js/lib/*.js", "!js/*.min.js"],
                tasks: ["clean", "browserify"]
            }
        }
    });

    grunt.loadNpmTasks("grunt-contrib-compass");
    grunt.loadNpmTasks("grunt-browserify");
    grunt.loadNpmTasks("grunt-contrib-clean");
    grunt.loadNpmTasks('grunt-contrib-watch');
};