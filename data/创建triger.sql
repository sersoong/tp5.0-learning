CREATE TRIGGER AutoUpdateTime_sersoong_teacher
AFTER UPDATE
on sersoong_teacher
FOR EACH row
BEGIN
UPDATE sersoong_teacher SET update_time=datetime(CURRENT_TIMESTAMP,'localtime') WHERE sersoong_teacher.id=old.id;
END;

CREATE TRIGGER AutoUpdateTime_sersoong_course
AFTER UPDATE
on sersoong_course
FOR EACH row
BEGIN
UPDATE sersoong_course SET update_time=datetime(CURRENT_TIMESTAMP,'localtime') WHERE sersoong_course.id=old.id;
END;

CREATE TRIGGER AutoUpdateTime_sersoong_klass
AFTER UPDATE
on sersoong_klass
FOR EACH row
BEGIN
UPDATE sersoong_klass SET update_time=datetime(CURRENT_TIMESTAMP,'localtime') WHERE sersoong_klass.id=old.id;
END;

CREATE TRIGGER AutoUpdateTime_sersoong_klass_course
AFTER UPDATE
on sersoong_klass_course
FOR EACH row
BEGIN
UPDATE sersoong_klass_course SET update_time=datetime(CURRENT_TIMESTAMP,'localtime') WHERE sersoong_klass_course.id=old.id;
END;

CREATE TRIGGER AutoUpdateTime_sersoong_student
AFTER UPDATE
on sersoong_student
FOR EACH row
BEGIN
UPDATE sersoong_student SET update_time=datetime(CURRENT_TIMESTAMP,'localtime') WHERE sersoong_student.id=old.id;
END;