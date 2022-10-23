//Built by Adar Elkabetz 2022
class Table
{
    parent
    config = {}
    
    setTbody(_tbody)
    {
        this.config.tbody = _tbody;
    }

    setRows(_rows)
    {
        this.config.rows = _rows;
    }

    render()
    {
        $(this.parent).empty();
    }
}