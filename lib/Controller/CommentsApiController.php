<?php
/**
 * @copyright Copyright (c) 2020 Julius Härtl <jus@bitgrid.net>
 *
 * @author Julius Härtl <jus@bitgrid.net>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\Deck\Controller;

use OCA\Deck\BadRequestException;
use OCA\Deck\Service\CommentService;
use OCA\Deck\StatusException;
use OCP\AppFramework\ApiController;
use OCP\AppFramework\Http\DataResponse;

use OCP\AppFramework\OCS\OCSException;
use OCP\AppFramework\OCSController;
use OCP\IRequest;

class CommentsApiController extends OCSController {

	/** @var CommentService */
	private $commentService;

	public function __construct(
		$appName, IRequest $request, $corsMethods = 'PUT, POST, GET, DELETE, PATCH', $corsAllowedHeaders = 'Authorization, Content-Type, Accept', $corsMaxAge = 1728000,
		CommentService $commentService
	) {
		parent::__construct($appName, $request, $corsMethods, $corsAllowedHeaders, $corsMaxAge);
		$this->commentService = $commentService;
	}

	/**
	 * @NoAdminRequired
	 * @throws StatusException
	 */
	public function list(string $cardId, int $limit = 20, int $offset = 0): DataResponse {
		return $this->commentService->list($cardId, $limit, $offset);
	}

	/**
	 * @NoAdminRequired
	 * @throws StatusException
	 */
	public function create(string $cardId, string $message, string $parentId = '0'): DataResponse {
		return $this->commentService->create($cardId, $message, $parentId);
	}

	/**
	 * @NoAdminRequired
	 * @throws StatusException
	 */
	public function update(string $cardId, string $commentId, string $message): DataResponse {
		return $this->commentService->update($cardId, $commentId, $message);
	}

	/**
	 * @NoAdminRequired
	 * @throws StatusException
	 */
	public function delete(string $cardId, string $commentId): DataResponse {
		return $this->commentService->delete($cardId, $commentId);
	}
}
