document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const feedbackTextarea = document.getElementById('feedback');
    const feedbackCounter = document.createElement('div');
    const maxFeedbackLength = 100; // Limite de caracteres para o feedback
    
    // Adicionar um contador de caracteres abaixo do campo de feedback
    feedbackCounter.id = 'feedback-counter';
    feedbackCounter.textContent = `0 / ${maxFeedbackLength}`;
    feedbackTextarea.parentNode.insertBefore(feedbackCounter, feedbackTextarea.nextSibling);

    // Atualizar o contador de caracteres ao digitar
    feedbackTextarea.addEventListener('input', function() {
        const feedbackLength = feedbackTextarea.value.length;
        feedbackCounter.textContent = `${feedbackLength} / ${maxFeedbackLength}`;

        if (feedbackLength > maxFeedbackLength) {
            feedbackCounter.style.color = 'red';
        } else {
            feedbackCounter.style.color = 'black';
        }
    });

    // Função para verificar se todas as perguntas foram respondidas
    function validateForm() {
        const questions = document.querySelectorAll('.question-block');
        let allAnswered = true;

        questions.forEach(question => {
            const checkedOption = question.querySelector('input[type="radio"]:checked');
            if (!checkedOption) {
                allAnswered = false;
                question.style.border = '1px solid red'; // Destacar perguntas não respondidas
            } else {
                question.style.border = 'none'; // Remover o destaque se já foi respondido
            }
        });

        return allAnswered;
    }

    // Adicionar uma confirmação antes do envio do formulário
    form.addEventListener('submit', function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Impede o envio do formulário
            alert('Por favor, responda todas as perguntas antes de enviar.');
            return;
        }

        const confirmed = confirm('Tem certeza que deseja enviar suas respostas?');
        if (!confirmed) {
            event.preventDefault(); // Impede o envio do formulário se o usuário cancelar
        }
    });
});
