<?php

  function admin() {
    return auth()->guard('admin')->user();
  }

  function lecturer() {
    return auth()->guard('lecturer')->user();
  }

  function student() {
    return auth()->guard('student')->user();
  }