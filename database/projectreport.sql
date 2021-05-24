
SELECT TMP.ReportYear, TMP.ReportMonth,  SUM(TMP.Unassigned), SUM(TMP.Assigned), SUM(TMP.Pending), SUM(TMP.Closed) FROM (

SELECT YEAR(`created_at`) AS ReportYear, MONTH(`created_at`) AS ReportMonth, count(`id`) as Unassigned, 0 AS Assigned, 0 AS Pending, 0 AS Closed FROM `tickets` WHERE `project_id` = 1 AND `status` = 0 GROUP BY YEAR(`created_at`) , MONTH(`created_at`) UNION ALL

SELECT YEAR(`created_at`) AS ReportYear, MONTH(`created_at`) AS ReportMonth, 0 AS Unassigned, count(`id`) AS  Assigned, 0 AS Pending, 0 AS Closed FROM `tickets` WHERE `project_id` = 1 AND `status` = 1 GROUP BY YEAR(`created_at`) , MONTH(`created_at`) UNION ALL

SELECT YEAR(`created_at`) AS ReportYear, MONTH(`created_at`) AS ReportMonth, 0 as Unassigned, 0 AS Assigned, count(`id`) as Pending, 0 AS Closed FROM `tickets` WHERE `project_id` = 1 AND `status` = 2 GROUP BY YEAR(`created_at`) , MONTH(`created_at`) UNION ALL

SELECT YEAR(`created_at`) AS ReportYear, MONTH(`created_at`) AS ReportMonth, 0 as Unassigned, 0 AS Assigned, 0 AS Pending, count(`id`) AS Closed FROM `tickets` WHERE `project_id` = 1 AND `status` = 3 GROUP BY YEAR(`created_at`) , MONTH(`created_at`)
    
) TMP GROUP BY ReportYear, ReportMonth ORDER BY ReportYear DESC, ReportMonth DESC


