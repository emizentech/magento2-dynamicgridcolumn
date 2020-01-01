<?php 

namespace Emizentech\DynamicGridColumn\Plugin;

use Magento\Framework\Message\ManagerInterface as MessageManager;
use Magento\Sales\Model\ResourceModel\Order\Grid\Collection as SalesOrderGridCollection;
use Magento\Framework\App\RequestInterface;

class AddColumnsSalesOrderGridCollection
{
   private $queryInjected = false;

   public function aroundGetSelect(\Magento\Sales\Model\ResourceModel\Order\Grid\Collection $subject, callable $proceed)
   {
        $select = $proceed();

        if(!$this->queryInjected && $select){
            $this->queryInjected = true;

            $select->joinLeft(
                ['sales_order' => new \Zend_Db_Expr($this->query())],
                'sales_order.entity_id = main_table.entity_id',
                ['customer_status']
            );
        }

        return $select;
    }

    protected function query(){
        $gerpTempTable = <<<SQL
            (SELECT CASE WHEN customer_id is NULL THEN "Guest" ELSE "Customer" END AS customer_status, entity_id FROM sales_order)         
SQL;
        return $gerpTempTable;
    }

}
