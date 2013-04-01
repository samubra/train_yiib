<?php
Yii::import ( 'application.models._base.BaseCategory' );
class Category extends BaseCategory {
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	public function relations() {
		return array (
				'user' => array (
						self::BELONGS_TO,
						'User',
						'uid' 
				),
				'node' => array (
						self::HAS_MANY,
						'Node',
						'cid' 
				) 
		);
	}
	/*
	 * public function behaviors() { return array( 'CTimestampBehavior' => array( 'class' => 'zii.behaviors.CTimestampBehavior', 'createAttribute' => null, 'updateAttribute' => 'modified', ) ); }
	 */
	public function beforeValidate() {
		if ($this->isNewRecord) {
			if ($this->hasAttribute ( 'uid' )) {
				$this->uid = user ()->id;
			}
		}
		return parent::beforeValidate ();
	}
	
	/**
	 * Returns the parent select options formatted as a tree.
	 * 
	 * @return array the options
	 */
	public function getParentOptionTree() {
		$category = Category::model ()->findAll ('uid=:uid',array(':uid'=>user()->id));
		
		if (! $this->isNewRecord) {
			$children = $this->getChildren ( $category, true );
			$exclude = CMap::mergeArray ( array (
					$this->id 
			), array_keys ( $children ) );
			$category = Category::model ()->findAll ( 'id NOT IN (:exclude) AND uid=:uid', array (
					':exclude' => implode ( ',', $exclude ) ,
					':uid'=>user()->id
			) );
		}
		
		$tree = $this->getTree ( $category,true );
		
		$options = array (
				'0' => Yii::t ( 'app', 'No parent' ) 
		);
		foreach ( $tree as $branch )
			$options = CMap::mergeArray ( $options, $this->getParentOptionBranch ( $branch ) );
		
		return $options;
	}
	
	/**
	 * Returns a single branch of the parent select option tree.
	 * 
	 * @param array $branch
	 *        	the branch
	 * @param int $depth
	 *        	the depth of the branch
	 * @return array the options
	 */
	protected function getParentOptionBranch($branch, $depth = 0) {
		$options = array ();
		
		$options [$branch ['model']->id] = str_repeat ( '...', $depth + 1 ) . ' ' . $branch ['model']->name;
		
		if (! empty ( $branch ['children'] ))
			foreach ( $branch ['children'] as $leaf )
				$options = CMap::mergeArray ( $options, $this->getParentOptionBranch ( $leaf, $depth + 1 ) );
		
		return $options;
	}
	
	/**
	 * Returns the given nodes as a tree.
	 * 
	 * @param CmsNode[] $category
	 *        	the nodes to process
	 * @param bool $includeOrphans
	 *        	indicated whether to include nodes which parent has been deleted.
	 * @return array the tree
	 */
	public function getTree($category, $includeOrphans = false) {
		$tree = $this->getBranch ( $category );
		
		// Get the orphan nodes as well (i.e. those which parent has been deleted) if necessary.
		if ($includeOrphans)
			foreach ( $category as $node )
				$tree [$node->id] = array (
						'model' => $node,
						'children' => $this->getBranch ( $category, $node->id ) 
				);
		
		return $tree;
	}
	
	/**
	 * Returns the given nodes as a branch.
	 * 
	 * @param
	 *        	CmsNode[]$category the nodes to process
	 * @param int $parent
	 *        	the parent id
	 * @return array the branch
	 */
	protected function getBranch(&$category, $parent = 0) {
		$children = array ();
		/**
		 * @var CmsNode $node
		 */
		foreach ( $category as $idx => $node ) {
			if (( int ) $node->parent === ( int ) $parent) {
				$children [$node->id] = array (
						'model' => $node,
						'children' => $this->getBranch ( $category, $node->id ) 
				);
				unset ( $category [$idx] );
			}
		}
		
		return $children;
	}
	
	/**
	 * Returns the children for this node.
	 * 
	 * @param CmsNode[] $category
	 *        	the nodes to process
	 * @param bool $recursive
	 *        	indicates whether to include grandchildren
	 * @return CmsNode[] the children
	 */
	protected function getChildren(&$category, $recursive = false) {
		$children = array ();
		
		/**
		 * @var CmsNode $node
		 */
		foreach ( $category as $idx => $node ) {
			if (( int ) $node->parent === ( int ) $this->id) {
				$children [$node->id] = $node;
				unset ( $category [$idx] );
				
				if ($recursive)
					$children = CMap::mergeArray ( $children, $node->getChildren ( $category, $recursive ) );
			}
		}
		
		return $children;
	}
	
	/**
	 * Renders the node tree.
	 */
	public function renderTree($model=null) {
		$category = is_null($model)?Category::model ()->findAll ('uid=:uid',array(':uid'=>user()->id)):$model;
		$tree = $this->getTree ( $category, true );
		
		/*echo CHtml::openTag ( 'div', array (
				'class' => 'item' 
		) );
		/*echo CHtml::openTag ( 'div', array (
				'class' => 'title' 
		) );*/
		
		foreach ( $tree as $branch )
			$this->renderBranch ( $branch );
		
		//echo '</div>';
		//echo '</div>';
	}
	
	/**
	 * Renders a single branch in the node tree.
	 * 
	 * @param array $branch
	 *        	the branch
	 */
	protected function renderBranch($branch) {
		//echo '<li>';
		echo CHtml::openTag ( 'div', array (
				'class' => 'item'
		) );
		echo CHtml::openTag ( 'div', array (
				'class' => 'title'
		) );
		/*echo CHtml::link ( $branch ['model']->name, array (
				'node/update',
				'id' => $branch ['model']->id 
		) );*/
		echo $branch ['model']->name;
		echo CHtml::link ( '<span class=" icon-edit"></span>', array (
				'category/update',
				'id' => $branch ['model']->id
		) );
		echo CHtml::link ( '<span class="icon-th-list"></span>', array (
				'node/index',
				'cid' => $branch ['model']->id
		) );
		echo CHtml::link ( '<span class="icon-remove"></span>', array (
				'category/delete',
				'id' => $branch ['model']->id
		) );
		echo '</div>';
		if (! empty ( $branch ['children'] )) {
			echo CHtml::openTag ( 'div', array (
					'class' => 'text' 
			) );
			foreach ( $branch ['children'] as $leaf )
				$this->renderBranch ( $leaf );
			
			echo '</div>';
		}
		
		echo '</div>';
	}
}