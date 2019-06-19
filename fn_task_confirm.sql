CREATE OR REPLACE FUNCTION public.fn_task_confirm (
  in_id integer
)
RETURNS integer AS'
DECLARE
BEGIN
	update task set status_id = 2 where id = in_id;
    RETURN 0;
END;
'LANGUAGE 'plpgsql'
VOLATILE
CALLED ON NULL INPUT
SECURITY INVOKER
COST 100;

ALTER FUNCTION public.fn_task_confirm (in_id integer)
  OWNER TO postgres;
