function changeFontSize(target) {
  var demo = document.getElementById("demo");
  var computedStyle = window.getComputedStyle
        ? getComputedStyle(demo) // Standards
        : demo.currentStyle;     // Old IE
  var fontSize;

  if (computedStyle) { // This will be true on nearly all browsers
      fontSize = parseFloat(computedStyle && computedStyle.fontSize);

      if (target == document.getElementById("button1")) {
        fontSize += 5;
      } else if (target == document.getElementById("button2")) {
        fontSize -= 5;
      }
      demo.style.fontSize = fontSize + "px";
  }
}