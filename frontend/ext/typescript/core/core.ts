import { ResearcherRegisterController } from "./../app/controller/ResearcherRegisterController.js";
import { ParticipantRegisterController } from "./../app/controller/ParticipantRegisterController.js";
import { ItemAnswerController } from "./../app/controller/ItemAnswerController.js";
import { QuizRegisterController } from "./../app/controller/QuizRegisterController.js";
import { SystemController } from "./../app/controller/SystemController.js";

(() => {
    new SystemController();
    switch (document.getElementsByTagName('body')[0].getAttribute('page')) {
        
        case 'researcher-register':
            new ResearcherRegisterController();
            break;

        case 'participant-register':
            new ParticipantRegisterController();
            break;

        case 'item-answer':
            new ItemAnswerController();
            break;
        
        case 'quiz-register':
            new QuizRegisterController();
            break;

        default:
            console.log("Wrong page entity");
        
    }
})();