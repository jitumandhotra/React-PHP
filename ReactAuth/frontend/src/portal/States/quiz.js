// __define-ocg__
import React, { useState } from 'react';

const questions = [
  {
    question: 'What is the capital of France?',
    options: ['London', 'Paris', 'Rome', 'Berlin'],
    answer: 'Paris'
  },
  {
    question: 'Which planet is known as the Red Planet?',
    options: ['Jupiter', 'Mars', 'Saturn', 'Earth'],
    answer: 'Mars'
  }
];

function Quiz() {
  const [currentQuestion, setCurrentQuestion] = useState(0);
  const [score, setScore] = useState(0);
  const [showFeedback, setShowFeedback] = useState(false);
  const [feedback, setFeedback] = useState('');

  const handleOptionChange = (e) => {
    const selectedAnswer = e.target.value;
    const correctAnswer = questions[currentQuestion].answer;
    const isCorrect = selectedAnswer === correctAnswer;

    if (isCorrect) {
      setScore(score + 1);
      setFeedback('Correct!');
    } else {
      setFeedback('Incorrect!');
    }

    setShowFeedback(true);

    setTimeout(() => {
      if (currentQuestion + 1 < questions.length) {
        setCurrentQuestion(currentQuestion + 1);
        setShowFeedback(false);
      } else {
        setFeedback(`Quiz Complete! You scored ${score + 1} out of ${questions.length}!`);
      }
    }, 2000);
  };

  return (
    <div className="quiz-container">
      {showFeedback && <div className="feedback">{feedback}</div>}
      <div className="question">{questions[currentQuestion].question}</div>
      <div className="options">
        {questions[currentQuestion].options.map((option, index) => (
          <div key={index} className="option">
            <input
              type="radio"
              id={`option${index + 1}`}
              name="answer"
              value={option}
              onChange={handleOptionChange}
            />
            <label htmlFor={`option${index + 1}`}>{option}</label>
          </div>
        ))}
      </div>
    </div>
  );
}

export default Quiz;
