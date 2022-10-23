//Built by Adar Elkabetz 2022
class Vertical_Table extends Table
{
    constructor(_parent,_config)
    {
        super();
        this.parent = _parent;
        this.config.tbody = _config.tbody;
        this.config.rows = _config.rows;
        this.config.classTable = _config?.classTable;
        this.config.styleTable = _config?.styleTable;
        this.config.styleTD = _config?.styleTD;
        return this;
    }

   render()
   {
        super.render();
        const $table = document.createElement("table");
        $table.className = this.config.classTable;
        $table.style = this.config.styleTable;
        $($table).append(this.createThead());
        this.createBody($table);
        $(this.parent).append($table);
   }

   createThead()
   {
        const $tbody = document.createElement("tbody");
        this.config.tbody.map((thTitle)=>{
            const $th = document.createElement("th");
            $th.style = `padding:8px;${this.config.styleTD}`
            $th.innerHTML = `${thTitle.title}`
            $($tbody).append($th);
        })
        return $tbody;
   }

   createBody($_table)
   {
        this.config.rows.map(row=>{
            const $tr = document.createElement("tr");
            this.config.tbody.map(colmn=>{
                const td = document.createElement("td");
                td.style = `${this.config.styleTD}`

                switch(colmn.method)
                {
                    case "text":
                        td.innerHTML = `
                        ${row[colmn.key]}
                        `
                        break;
                    case "function":
                    $(td).append(colmn.callback(row))
                }

                $($tr).append(td);
            })
            $($_table).append($tr);
        })
   }
}