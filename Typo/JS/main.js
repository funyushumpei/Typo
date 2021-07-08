//おまじない
"use strict";

//単語
const words = ["apple", "banana", "lemon"];

let word; //タイピングワード
let loc; //文字の位置
let score; //正解の文字数
let miss; //ミスの文字数
const timeLimit = 30 * 1000; //制限時間 ミリ秒のため*1000
let startTime; //開始時間
let isPlaying = false; //ゲーム中フラグ
let missflag = false;

const target = document.getElementById("target");
const scoreLabel = document.getElementById("score");
const missLabel = document.getElementById("miss");
const timerLabel = document.getElementById("timer");
let dictionary;

for (let i = 0; i < localStorage.length; i++) {
  var key = localStorage.key(i);
  dictionary = localStorage.getItem(key);
  $("#dictionary").append(dictionary);
}
function updateTarget() {
  //文字数のアンダーバー表示
  let placeholder = "";
  for (let i = 0; i < loc; i++) {
    placeholder += "_";
  }
  //要確認
  target.textContent = placeholder + word.substring(loc);
}

function updateTimer() {
  //開始時間を計算
  const timeLeft = startTime + timeLimit - Date.now();
  timerLabel.textContent = (timeLeft / 1000).toFixed(2);

  const timeoutId = setTimeout(() => {
    updateTimer();
  }, 10);

  //残り時間が無くなったら終了
  if (timeLeft < 0) {
    isPlaying = false;
    clearTimeout(timeoutId);
    timerLabel.textContent = "0.00";
    target.textContent = "click to replay";
  }
}

// 結果表示
function showResult() {
  alert("正解の文字数:${score},ミスの文字数:${miss}");
}

//スタートボタンを押された時の処理
window.addEventListener("click", () => {
  //プレイ中
  if (isPlaying === true) {
    return;
  }
  isPlaying = true;
  loc = 0;
  score = 0;
  miss = 0;
  scoreLabel.textContent = score;
  missLabel.textContent = miss;

  //ランダムで単語を選択
  word = words[Math.floor(Math.random() * words.length)];
  target.textContent = word;
  startTime = Date.now();
  updateTimer();
});

//キーボードの入力処理
window.addEventListener("keydown", (e) => {
  if (isPlaying !== true) {
    return;
  }
  //正しいアルファベットの時
  if (e.key === word[loc]) {
    loc++;

    if (loc === word.length) {
      if (missflag !== true) {
        localStorage.removeItem(word);
      } else {
        missflag = false;
      }
      word = words[Math.floor(Math.random() * words.length)];
      loc = 0;
    }
    updateTarget();
    score++;
    scoreLabel.textContent = score;
  } else {
    miss++;
    missflag = true;
    missLabel.textContent = miss;
    localStorage.setItem(word, word);
  }
});

window.addEventListener("keydown", (event) => {
  if (event.code === "Delete") {
    localStorage.clear();
  }
});
