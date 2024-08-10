import './bootstrap';
import './custom';

import timeComponent from './lib/time';

import createNewUser from './lib/createNewUser';

import createNewStudent from './lib/createNewStudent';

import studentInactive from './lib/studentInactive';

import userMessage from './lib/userMessage';

import userMessageIndex from './lib/userMessageIndex';

import studentCourseQuestion from './lib/student/courseQuestion';

import studentSendAnswer from './lib/student/sendAnswer';

import adminMissionTaskFreeText from './lib/admin/mission/task_free_text';

import adminMissionTaskHesas from './lib/admin/mission/task_hesas';

import adminMissionTaskOneSurat from './lib/admin/mission/task_one_surat';

import adminMissionTaskSuratToSurat from './lib/admin/mission/task_surat_to_surat';

import adminMissionTaskAyaToAya from './lib/admin/mission/task_aya_to_aya';

import adminStudentMissionTask from './lib/admin/student/mission_task';

import adminRequestleavStatus from './lib/admin/requestleave/status';

import studentAttendanceRecordDaily from './lib/student/attendance/student_has_record_daily';


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('timeComponent', timeComponent)

Alpine.data('createNewUser', createNewUser)

Alpine.data('createNewStudent', createNewStudent)

Alpine.data('studentInactive', studentInactive)

Alpine.data('userMessage', userMessage)

Alpine.data('userMessageIndex', userMessageIndex)

Alpine.data('studentCourseQuestion', studentCourseQuestion)

Alpine.data('studentSendAnswer', studentSendAnswer)

Alpine.data('adminMissionTaskFreeText', adminMissionTaskFreeText)

Alpine.data('adminMissionTaskHesas', adminMissionTaskHesas)

Alpine.data('adminMissionTaskOneSurat', adminMissionTaskOneSurat)

Alpine.data('adminMissionTaskSuratToSurat', adminMissionTaskSuratToSurat)

Alpine.data('adminMissionTaskAyaToAya', adminMissionTaskAyaToAya)

Alpine.data('adminStudentMissionTask', adminStudentMissionTask)

Alpine.data('adminRequestleavStatus', adminRequestleavStatus)

Alpine.data('studentAttendanceRecordDaily', studentAttendanceRecordDaily)

Alpine.start();
