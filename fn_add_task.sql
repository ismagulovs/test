CREATE OR REPLACE FUNCTION public.fn_add_task (
  in_admin_id integer,
  in_user_id integer,
  in_title varchar,
  in_descr varchar,
  in_start_date timestamp,
  in_status_id smallint,
  in_term_cnt smallint,
  in_task_id integer
)
RETURNS integer AS'
DECLARE
BEGIN
  INSERT INTO public.task (admin_id, descr, start_date, title, status_id, term_cnt, user_id, task_id)
  VALUES (in_admin_id, in_descr, in_start_date, in_title, in_status_id, in_term_cnt, in_user_id, in_task_id);
  RETURN 0;
END;
'LANGUAGE 'plpgsql'
VOLATILE
CALLED ON NULL INPUT
SECURITY INVOKER
COST 100;

ALTER FUNCTION public.fn_add_task (in_admin_id integer, in_user_id integer, in_title varchar, in_descr varchar, in_start_date timestamp, in_status_id smallint, in_term_cnt smallint, in_task_id integer)
  OWNER TO postgres;
