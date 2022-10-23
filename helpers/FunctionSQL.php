<?php
function SQL_UpdateBind($MySQLUpdateArray, $TBName, $Condition, $mysqli = null)
{
    if (!$mysqli) 
    {
        global $mysqli;
    }

    $ColumnList = implode(" = ?, ", array_keys($MySQLUpdateArray));
    $ColumnList .= ' = ?';

    $stmtUpdate = $mysqli->prepare("UPDATE " . $TBName . " SET " . $ColumnList . " " . $Condition);
    $ValueList = array_values($MySQLUpdateArray);
    $types = array_column($ValueList, 0);
    $bind = implode("", $types);
    
    $ValueToInsert = array_column($ValueList, 1);
    
    $stmtUpdate->bind_param($bind, ...$ValueToInsert);
    $stmtUpdate->execute();
    
    if ($stmtUpdate->affected_rows > 0) 
    {
        $stmtUpdate->close();
        return true;
    }

    $stmtUpdate->close();

    return false;
}

function SQL_SelectBind($MySQLSelectArray, $TBName, $isNum = true, $mysqli = null, $fields = '*', $Condition = null)
{
    if (!$mysqli) 
    {
        global $mysqli;
    }

    if ($Condition != null) 
    {
        if ($MySQLSelectArray == null) 
        {
            $Condition = " where " . $Condition;
        } 
        else 
        {
            $Condition = " and " . $Condition;
        }
    }

    if ($MySQLSelectArray == null) 
    {
        $stmt = $mysqli->prepare("SELECT $fields FROM " . $TBName . $Condition);
    } 
    else 
    {
        $ColumnList = implode(" = ? AND ", array_keys($MySQLSelectArray));
        $ColumnList .= ' = ?';
        $stmt = $mysqli->prepare("SELECT $fields FROM " . $TBName . " WHERE " . $ColumnList . $Condition);
        $ValueList = array_values($MySQLSelectArray);
        $types = array_column($ValueList, 0);
        $bind = implode("", $types);
        $ValueToInsert = array_column($ValueList, 1);
        $stmt->bind_param($bind, ...$ValueToInsert);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    if ($isNum) 
    {
        return $result->num_rows;
    }

    return $result;
}

function SQL_InsertBind($MySQLInsertArray, $TBName, $mysqli = null)
{
    if (!$mysqli) 
    {
        global $mysqli;
    }

    $ColumnList = implode(",", array_keys($MySQLInsertArray));
    $ValueList = array_values($MySQLInsertArray);
    $is = array_column($ValueList, 0);
    $bind = implode("", $is);
    $MySQLQs = str_repeat("?,", strlen($bind) - 1) . "?";
    $ValueToInsert = array_column($ValueList, 1);

    $stmtinsert = $mysqli->prepare("INSERT INTO " . $TBName . " (" . $ColumnList . ") VALUES (" . $MySQLQs . ")");

    $stmtinsert->bind_param($bind, ...$ValueToInsert);
    $stmtinsert->execute();

    if ($stmtinsert->affected_rows > 0) 
    {
        $last_id = $mysqli->insert_id;
        $stmtinsert->close();
        return $last_id;
    }

    $stmtinsert->close();
    
    return false;
}
?>