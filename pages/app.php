<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include('../php/head.php'); ?>
  </head>
  <body id="app">
    <?php include('../php/navbar.php'); ?>

    <!-- Import blockly libraries -->
    <script src="../js/blockly/blockly_compressed.js"></script> <!-- Core -->
    <script src="../js/blockly/javascript_compressed.js"></script> <!-- Translates block to JS -->
    <script src="../js/blockly/blocks_compressed.js"></script> <!-- Block sets -->
    <script src="../js/blockly/msg/js/en.js"></script> <!-- Language -->

    <!-- Custom blocks -->
    <script src="../js/movement_blocks.js"></script>

    <!-- Instructions, Story Canvas, and Run/Reset container -->
    <div id="simContainer">
      <header>
        <select id="storySelector" onchange="loadStory(this.value)">
          <option value="the_very_hungry_caterpillar">The Very Hungry Caterpillar</option>
          <option value="green_eggs_and_ham">Green Eggs and Ham</option>
        </select>
      </header>
      <div id="levelsContainer">
        <!-- Default contents; levels should be filled with JavaScript. -->
        <button>0</button>
      </div>
      <!-- Character and other elements canvas -->
      <!-- Note: Separate because applying transformations to character; can not do this with one canvas. -->
      <div id="canvasWrapper">
        <canvas id="charCanvas"></canvas>
        <canvas id="storyCanvas"></canvas>
      </div>
      <!-- Story subtitles -->
      <div id="btns">
        <!-- JavaScript output text box -->
        <!-- <textarea id="jsCode"></textarea> -->
        <button class="orangeBtn" onclick="initCutscene()" style="float:left;">Skip (Demo)</button>
        <button id="reset" class="orangeBtn" onclick="resetSim()">Reset</button>
        <button id="run" class="orangeBtn" onclick="runCode()">Run</button>
      </div>
    </div>
    <!-- Blockly workspace: container holding toolbox and block code -->
    <div id="wsContainer">
      <div id="instructions">
        <h1>Instructions:</h1>
        <h2>You are <span id="charName">undefined</span>.</h2>
        <h2>Use the code blocks to navigate through the maze.</h2>
        <h2>Reach the <span id="goalName">undefined</span>, avoid the <span id="boundName">undefined</span>!</h2>
      </div>
      <!-- Blockly Coding Space -->
      <div id="workspace"></div>
      <xml id="toolbox">
        <category name="Movement" colour="180">
          <block type="movement_move_forward"></block>
          <block type="movement_turn_lr"></block>
        </category>
        <category name="Loops" colour="300">
          <block type="controls_repeat_ext"></block>
          <block type="math_number"></block>
        </category>
      </xml>
    </div>

    <div id="cutsceneWrapper">
      <div id="cutsceneScreen"></div>
      <img id="cutsceneImgA" class="cutsceneImg" />
      <img id="cutsceneImgB" class="cutsceneImg" />
      <button id="cutsceneBtn" disabled>
        <h1>></h1>
      </button>
    </div>

    <!-- Allows for controlled execution of block code -->
    <script src="../js/interpreter/acorn_interpreter.js"></script>
    <!-- JS-Interpreter API to handle external actions -->
    <script src="../js/interpreterAPI.js"></script>
    <!-- TEMPORARY: Story/Maze Data -->
    <script src="../js/data.js"></script>
    <!-- Global -->
    <script src="../js/main.js"></script>
    <!-- Using blockly library -->
    <script src="../js/blockly.js"></script>
    <!-- Handles stories' cutscenes -->
    <script src="../js/story.js"></script>
    <!-- Controls canvas initialization and manipulation -->
    <script src="../js/canvas.js"></script>
  </body>
</html>
