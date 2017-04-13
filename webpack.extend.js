const fs = require('fs');
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
                // amd: false,
                // prettify: true,
                // separator: '\n',
                namespace: 'Qwikkar',
                processName: function (name) {
                    let path = name.replace(/\\/g, '/').split('/');
                    let data = [], t = 0;
                    for (let i = 0; i <= (path.length - 1); i++) {
                        if (t)
                            data.push(path[i]);
                        if (path[i] === 'templates')
                            t = 1;
                    }
                    return data.join('/');
                }
            }))
            .pipe(gulp.dest('public/js'));
    },

    delete: function (files) {
        let delFiles = [];
        if (typeof files === 'string')
            delFiles.push(files);
        else if (typeof files === 'object')
            delFiles = files;

        console.log(delFiles);
        fs.readFile('public/js/jst.js', (err, data) => {
            if (err) console.error('read error', err);
            else
                fs.unlink('public/js/jst.js', (err) => {
                    if (err) console.error('unlink error', err);
                    else console.log('successfully deleted.');
                });
        });
    }
};

