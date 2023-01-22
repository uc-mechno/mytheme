const { watch, parallel } = require("gulp");
const browserSync = require("browser-sync");

const path = {
  css: "./assets/css/**/*.css",
  js: "./assets/js/**/*.js",
  php: "./**/*.php",
};

const buildServer = (done) => {
  browserSync.init({
    // 静的サイト
    // files: ["**/*"],
    // server: { baseDir: "./" },
    // 動的サイト
    proxy: "pacificmall.local",
    browser: "Google Chrome",
    // port: 8080, // TODO：表示されないためコメントアウト
    notify: true,
    open: false,
    watchOptions: { debounceDelay: 1000 },
    reloadDelay: 1000,
    reloadOnRestart: true,
    ghostMode: false,
  });
  done();
};

const browserReload = (done) => {
  browserSync.reload();
  done();
};

const watchFiles = () => {
  watch(path.php, browserReload);
  watch(path.css, browserReload);
  watch(path.js, browserReload);
};

module.exports = {
  default: parallel(buildServer, watchFiles),
};
