import { ResearcherRegisterController } from "./../app/controller/ResearcherRegisterController.js";
import { ParticipantRegisterController } from "./../app/controller/ParticipantRegisterController.js";
(() => {
    switch (document.getElementsByTagName('body')[0].getAttribute('page')) {
        case 'researcher-register':
            new ResearcherRegisterController();
            break;
        case 'participant-register':
            new ParticipantRegisterController();
            break;
        default:
            console.log("Wrong page entity");
    }
})();
//# sourceMappingURL=core.js.map