const gulp = require('gulp');
const tojst = require('gulp-tojst');


module.exports = {

    run: function () {
        this.jst();
    },

    jst: function () {
        gulp
            .src('resources/assets/templates/**/*.html')
            .pipe(tojst('jst.js', {
                amd: false,
                prettify: true,
                separator: '\n',
                namespace: 'Qwikkar',
                processName: this.getFileName
            }))
            .pipe(gulp.dest('public/js'));
    },

    getFileName: function (name) {
        let path = name.replace(/\\/g, '/').split('/');
        let data = [], t = 0;
        for (let i = 0; i < path.length; i++) {
            if (t)
                data.push(path[i]);
            if (path[i] === 'templates')
                t = 1;
        }
        return data.join('/');
    }
};

