/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/extras.js":
/*!********************************!*\
  !*** ./resources/js/extras.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

eval("window[\"switch\"] = __webpack_require__(/*! light-switch-bootstrap/switch */ \"./node_modules/light-switch-bootstrap/switch.js\");\n;//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvZXh0cmFzLmpzLmpzIiwibWFwcGluZ3MiOiJBQUFBQSxNQUFNLFVBQU4sR0FBZ0JDLG1CQUFPLENBQUMsc0ZBQUQsQ0FBdkI7QUFBeUQiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvZXh0cmFzLmpzPzFhYmYiXSwic291cmNlc0NvbnRlbnQiOlsid2luZG93LnN3aXRjaCA9IHJlcXVpcmUoJ2xpZ2h0LXN3aXRjaC1ib290c3RyYXAvc3dpdGNoJyk7O1xuIl0sIm5hbWVzIjpbIndpbmRvdyIsInJlcXVpcmUiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/extras.js\n");

/***/ }),

/***/ "./node_modules/light-switch-bootstrap/switch.js":
/*!*******************************************************!*\
  !*** ./node_modules/light-switch-bootstrap/switch.js ***!
  \*******************************************************/
/***/ (() => {

eval("/**\n *  Light Switch @version v0.1.3\n */\n\n(function () {\n  let lightSwitch = document.getElementById(\"lightSwitch\");\n  if (!lightSwitch) {\n    return;\n  }\n  \n  /**\n   * @function darkmode\n   * @summary: changes the theme to 'dark mode' and save settings to local stroage.\n   * Basically, replaces/toggles every CSS class that has '-light' class with '-dark'\n   */\n  function darkMode() {\n    document.querySelectorAll(\".bg-light\").forEach((element) => {\n      element.className = element.className.replace(/-light/g, \"-dark\");\n    });\n\n    document.body.classList.add(\"bg-dark\");\n\n    if (document.body.classList.contains(\"text-dark\")) {\n      document.body.classList.replace(\"text-dark\", \"text-light\");\n    } else {\n      document.body.classList.add(\"text-light\");\n    }\n    \n    // set light switch input to true\n    if (! lightSwitch.checked) {\n      lightSwitch.checked = true;\n    }\n    localStorage.setItem(\"lightSwitch\", \"dark\");\n  }\n\n  /**\n   * @function lightmode\n   * @summary: changes the theme to 'light mode' and save settings to local stroage.\n   */\n  function lightMode() {\n    document.querySelectorAll(\".bg-dark\").forEach((element) => {\n      element.className = element.className.replace(/-dark/g, \"-light\");\n    });\n\n    document.body.classList.add(\"bg-light\");\n\n    if (document.body.classList.contains(\"text-light\")) {\n      document.body.classList.replace(\"text-light\", \"text-dark\");\n    } else {\n      document.body.classList.add(\"text-dark\");\n    }\n    \n    if (lightSwitch.checked) {\n      lightSwitch.checked = false;\n    }\n    localStorage.setItem(\"lightSwitch\", \"light\");\n  }\n  \n  /**\n   * @function onToggleMode\n   * @summary: the event handler attached to the switch. calling @darkMode or @lightMode depending on the checked state.\n   */\n  function onToggleMode() {\n    if (lightSwitch.checked) {\n      darkMode();\n    } else {\n      lightMode();\n    }\n  }\n  \n  /**\n   * @function getSystemDefaultTheme\n   * @summary: get system default theme by media query\n   */\n  function getSystemDefaultTheme() {\n    const darkThemeMq = window.matchMedia(\"(prefers-color-scheme: dark)\");\n    if (darkThemeMq.matches) {\n      return \"dark\";\n    }\n    return \"light\";\n  }\n\n  function setup() {\n    var settings = localStorage.getItem(\"lightSwitch\");\n    if (settings == null) {\n      settings = getSystemDefaultTheme();\n    }\n    \n    if (settings == \"dark\") {\n      lightSwitch.checked = true;\n    }\n    \n    lightSwitch.addEventListener(\"change\", onToggleMode);\n    onToggleMode();\n  }\n  \n  setup();\n  \n})();\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9ub2RlX21vZHVsZXMvbGlnaHQtc3dpdGNoLWJvb3RzdHJhcC9zd2l0Y2guanMuanMiLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxLQUFLOztBQUVMOztBQUVBO0FBQ0E7QUFDQSxNQUFNO0FBQ047QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsS0FBSzs7QUFFTDs7QUFFQTtBQUNBO0FBQ0EsTUFBTTtBQUNOO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsTUFBTTtBQUNOO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLENBQUMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9ub2RlX21vZHVsZXMvbGlnaHQtc3dpdGNoLWJvb3RzdHJhcC9zd2l0Y2guanM/MDM0YyJdLCJzb3VyY2VzQ29udGVudCI6WyIvKipcbiAqICBMaWdodCBTd2l0Y2ggQHZlcnNpb24gdjAuMS4zXG4gKi9cblxuKGZ1bmN0aW9uICgpIHtcbiAgbGV0IGxpZ2h0U3dpdGNoID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJsaWdodFN3aXRjaFwiKTtcbiAgaWYgKCFsaWdodFN3aXRjaCkge1xuICAgIHJldHVybjtcbiAgfVxuICBcbiAgLyoqXG4gICAqIEBmdW5jdGlvbiBkYXJrbW9kZVxuICAgKiBAc3VtbWFyeTogY2hhbmdlcyB0aGUgdGhlbWUgdG8gJ2RhcmsgbW9kZScgYW5kIHNhdmUgc2V0dGluZ3MgdG8gbG9jYWwgc3Ryb2FnZS5cbiAgICogQmFzaWNhbGx5LCByZXBsYWNlcy90b2dnbGVzIGV2ZXJ5IENTUyBjbGFzcyB0aGF0IGhhcyAnLWxpZ2h0JyBjbGFzcyB3aXRoICctZGFyaydcbiAgICovXG4gIGZ1bmN0aW9uIGRhcmtNb2RlKCkge1xuICAgIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoXCIuYmctbGlnaHRcIikuZm9yRWFjaCgoZWxlbWVudCkgPT4ge1xuICAgICAgZWxlbWVudC5jbGFzc05hbWUgPSBlbGVtZW50LmNsYXNzTmFtZS5yZXBsYWNlKC8tbGlnaHQvZywgXCItZGFya1wiKTtcbiAgICB9KTtcblxuICAgIGRvY3VtZW50LmJvZHkuY2xhc3NMaXN0LmFkZChcImJnLWRhcmtcIik7XG5cbiAgICBpZiAoZG9jdW1lbnQuYm9keS5jbGFzc0xpc3QuY29udGFpbnMoXCJ0ZXh0LWRhcmtcIikpIHtcbiAgICAgIGRvY3VtZW50LmJvZHkuY2xhc3NMaXN0LnJlcGxhY2UoXCJ0ZXh0LWRhcmtcIiwgXCJ0ZXh0LWxpZ2h0XCIpO1xuICAgIH0gZWxzZSB7XG4gICAgICBkb2N1bWVudC5ib2R5LmNsYXNzTGlzdC5hZGQoXCJ0ZXh0LWxpZ2h0XCIpO1xuICAgIH1cbiAgICBcbiAgICAvLyBzZXQgbGlnaHQgc3dpdGNoIGlucHV0IHRvIHRydWVcbiAgICBpZiAoISBsaWdodFN3aXRjaC5jaGVja2VkKSB7XG4gICAgICBsaWdodFN3aXRjaC5jaGVja2VkID0gdHJ1ZTtcbiAgICB9XG4gICAgbG9jYWxTdG9yYWdlLnNldEl0ZW0oXCJsaWdodFN3aXRjaFwiLCBcImRhcmtcIik7XG4gIH1cblxuICAvKipcbiAgICogQGZ1bmN0aW9uIGxpZ2h0bW9kZVxuICAgKiBAc3VtbWFyeTogY2hhbmdlcyB0aGUgdGhlbWUgdG8gJ2xpZ2h0IG1vZGUnIGFuZCBzYXZlIHNldHRpbmdzIHRvIGxvY2FsIHN0cm9hZ2UuXG4gICAqL1xuICBmdW5jdGlvbiBsaWdodE1vZGUoKSB7XG4gICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChcIi5iZy1kYXJrXCIpLmZvckVhY2goKGVsZW1lbnQpID0+IHtcbiAgICAgIGVsZW1lbnQuY2xhc3NOYW1lID0gZWxlbWVudC5jbGFzc05hbWUucmVwbGFjZSgvLWRhcmsvZywgXCItbGlnaHRcIik7XG4gICAgfSk7XG5cbiAgICBkb2N1bWVudC5ib2R5LmNsYXNzTGlzdC5hZGQoXCJiZy1saWdodFwiKTtcblxuICAgIGlmIChkb2N1bWVudC5ib2R5LmNsYXNzTGlzdC5jb250YWlucyhcInRleHQtbGlnaHRcIikpIHtcbiAgICAgIGRvY3VtZW50LmJvZHkuY2xhc3NMaXN0LnJlcGxhY2UoXCJ0ZXh0LWxpZ2h0XCIsIFwidGV4dC1kYXJrXCIpO1xuICAgIH0gZWxzZSB7XG4gICAgICBkb2N1bWVudC5ib2R5LmNsYXNzTGlzdC5hZGQoXCJ0ZXh0LWRhcmtcIik7XG4gICAgfVxuICAgIFxuICAgIGlmIChsaWdodFN3aXRjaC5jaGVja2VkKSB7XG4gICAgICBsaWdodFN3aXRjaC5jaGVja2VkID0gZmFsc2U7XG4gICAgfVxuICAgIGxvY2FsU3RvcmFnZS5zZXRJdGVtKFwibGlnaHRTd2l0Y2hcIiwgXCJsaWdodFwiKTtcbiAgfVxuICBcbiAgLyoqXG4gICAqIEBmdW5jdGlvbiBvblRvZ2dsZU1vZGVcbiAgICogQHN1bW1hcnk6IHRoZSBldmVudCBoYW5kbGVyIGF0dGFjaGVkIHRvIHRoZSBzd2l0Y2guIGNhbGxpbmcgQGRhcmtNb2RlIG9yIEBsaWdodE1vZGUgZGVwZW5kaW5nIG9uIHRoZSBjaGVja2VkIHN0YXRlLlxuICAgKi9cbiAgZnVuY3Rpb24gb25Ub2dnbGVNb2RlKCkge1xuICAgIGlmIChsaWdodFN3aXRjaC5jaGVja2VkKSB7XG4gICAgICBkYXJrTW9kZSgpO1xuICAgIH0gZWxzZSB7XG4gICAgICBsaWdodE1vZGUoKTtcbiAgICB9XG4gIH1cbiAgXG4gIC8qKlxuICAgKiBAZnVuY3Rpb24gZ2V0U3lzdGVtRGVmYXVsdFRoZW1lXG4gICAqIEBzdW1tYXJ5OiBnZXQgc3lzdGVtIGRlZmF1bHQgdGhlbWUgYnkgbWVkaWEgcXVlcnlcbiAgICovXG4gIGZ1bmN0aW9uIGdldFN5c3RlbURlZmF1bHRUaGVtZSgpIHtcbiAgICBjb25zdCBkYXJrVGhlbWVNcSA9IHdpbmRvdy5tYXRjaE1lZGlhKFwiKHByZWZlcnMtY29sb3Itc2NoZW1lOiBkYXJrKVwiKTtcbiAgICBpZiAoZGFya1RoZW1lTXEubWF0Y2hlcykge1xuICAgICAgcmV0dXJuIFwiZGFya1wiO1xuICAgIH1cbiAgICByZXR1cm4gXCJsaWdodFwiO1xuICB9XG5cbiAgZnVuY3Rpb24gc2V0dXAoKSB7XG4gICAgdmFyIHNldHRpbmdzID0gbG9jYWxTdG9yYWdlLmdldEl0ZW0oXCJsaWdodFN3aXRjaFwiKTtcbiAgICBpZiAoc2V0dGluZ3MgPT0gbnVsbCkge1xuICAgICAgc2V0dGluZ3MgPSBnZXRTeXN0ZW1EZWZhdWx0VGhlbWUoKTtcbiAgICB9XG4gICAgXG4gICAgaWYgKHNldHRpbmdzID09IFwiZGFya1wiKSB7XG4gICAgICBsaWdodFN3aXRjaC5jaGVja2VkID0gdHJ1ZTtcbiAgICB9XG4gICAgXG4gICAgbGlnaHRTd2l0Y2guYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLCBvblRvZ2dsZU1vZGUpO1xuICAgIG9uVG9nZ2xlTW9kZSgpO1xuICB9XG4gIFxuICBzZXR1cCgpO1xuICBcbn0pKCk7XG4iXSwibmFtZXMiOltdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./node_modules/light-switch-bootstrap/switch.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./resources/js/extras.js");
/******/ 	
/******/ })()
;